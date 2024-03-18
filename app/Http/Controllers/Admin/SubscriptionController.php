<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBilling;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    
    public function index(Request $request) {
        $isSubscribed = Auth::user()->subscribed('default');
        $invoices = Auth::user()->invoices();
        if($isSubscribed) {
            $expirationDate = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
            $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
            return view('admin.subscription.detail')
            ->with('expirationDate', $expirationDate ?? null)
            ->with('onGracePeriode', $onGracePeriode ?? false)
            ->with('invoices', $invoices);
        } else {
            $stores = Auth::user()->stores;
            return view('admin.subscription.subscribe')
            ->with('checkout', $request->checkout)  // retour de stripe checkout
            ->with('stores', $stores)  // retour de stripe checkout
            // ->with('isSubscribed', $isSubscribed)
            // ->with('expirationDate', $expirationDate ?? null)
            // ->with('onGracePeriode', $onGracePeriode ?? false)
            ->with('invoices', $invoices);
        }
        
    }
    // public function index(Request $request) {
    //     $isSubscribed = Auth::user()->subscribed('default');
    //     if($isSubscribed) {
    //         $expirationDate = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
    //         $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
    //     }
    //     $invoices = Auth::user()->invoices();
    //     // $cancelled = Auth::user()->subscription('default')->canceled();
    //     return view('admin.subscription.index')
    //         ->with('checkout', $request->checkout)  // retour de stripe checkout
    //         ->with('isSubscribed', $isSubscribed)
    //         ->with('expirationDate', $expirationDate ?? null)
    //         ->with('onGracePeriode', $onGracePeriode ?? false)
    //         ->with('invoices', $invoices);
    // }

    // public function subscribeWithStripeCheckout(StoreBilling $request)
    public function subscribeWithStripeCheckout(Request $request)
    {
        // // sauvegarde de la facturation en json
        // $billing = $request->except(['_token', 'abonnement']);
        // $user = User::find(Auth::id());
        // $user->billing = $billing;
        // $user->save();

        // if(is_null($request->store_id)) {
        //     $name = $request->societe ? $request->societe : $request->prenom.' '.$request->nom;
        //     $adresse1 = $request->adresse1;
        //     $adresse2 = $request->adresse2;
        //     $cp = $request->cp;
        //     $ville = $request->ville;
        // } else {
        //     $store = Store::find($request->store_id);
        //     $name = $store->name;
        //     $adresse1 = $store->adresse1;
        //     $adresse2 = $store->adresse2;
        //     $cp = $store->cp;
        //     $ville = $store->ville;
        // }

        // $billing = json_decode(Auth::user()->billing, true);
        

        // https://stripe.com/docs/api/checkout/sessions/create
        // $product = Produit::produitAbonnementUser();
        $product = 'price_1OpwrMF73qwd826kaoCtS5tr';
        // return $request->user()->newSubscription('default', $product->stripe_product_id)

        return $request->user()->newSubscription('default', $product)
            ->checkout([
                // 'success_url' => route('admin.subscribe.waiting'),
                'success_url' => route('admin.subscribe.success'),
                'cancel_url' => route('admin.subscribe.index', ['checkout' => 'cancel']),
                'customer_update' => [
                    'address' => 'auto',
                    'name' => 'auto',
                ],
                'billing_address_collection' => 'required',
                // 'subscription_data' => [
                //     'metadata' => [
                //         'user_id' => $request->user()->id,
                //         'produit_id' => $product->id,
                //         'method' => 'subscription',
                //         'price' => $product->price,
                //         'quantity' => 1,
                //         'amount' => $product->price,
                //     ]
                // ]
            ]);
        
    }

    public function stripeAttenteFinalisation(Request $request) {
        if(Auth::user()->subscribed('default')) {
            session(['is_abonne' => true]);
            return redirect()->route('dashboard')
                ->with('status', 'success')
                ->with('msg', 'Merci ! Vous êtes maintenant abonné(e) au service '.config('app.name'));
        } else {
            return view("admin.ubscription.waiting");
        }
    }

    public function success() {
        return view('admin.subscription.success');
    }

    public function invoice($invoiceId) {
        
        // $billing = json_decode(Auth::user()->billing, true);
        // $store = Store::find($billing['store_id']);
        // if(is_null($billing['store_id'])) {

        // } else {
        //     $store = Store::find($billing['store_id']);
        // }
        // dd($billing);
        //$store = Auth::user()->store;
        return Auth::user()->downloadInvoice($invoiceId, [
            'vendor' => 'ET BAM Solutions',
            // 'product' => 'Abonnement',
            'street' => '33 rue Claire Joie',
            'location' => '83200 Toulon, France',
            // 'phone' => '+32 499 00 00 00',
            'email' => 'contact@etbamsolutions.com',
            'url' => config('app.url'),
            'vendorVat' => 'FR49983750118',
            // 'customer_name' => ucfirst($billing['prenom']).' '.strtoupper($billing['nom']),
            // 'customer_store_name' => $store ? $store->name : $billing['societe'],
            // 'customer_store_adresse1' => $store ? $store->adresse1 : $billing['adresse1'],
            // 'customer_store_adresse2' => $store ? $store->adresse2 : $billing['adresse2'],
            // 'customer_store_cp' => $store ? $store->cp : $billing['cp'],
            // 'customer_store_ville' => $store ? $store->ville : $billing['ville'],
        ]);
    }

    public function cancel()
    {
        $finsouscription = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
        return view("admin.subscription.cancel")
            ->with('onGracePeriode', false)
            ->with('finsouscription', $finsouscription);
    }

    public function cancelsubscription(Request $request)
    {
        Auth::user()->subscription('default')->cancel();
        $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
        $finsouscription = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
        return view("admin.subscription.cancel")
            ->with('onGracePeriode', $onGracePeriode)
            ->with('finsouscription', $finsouscription);
    }

    public function resume(Request $request)
    {
        $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
        $finsouscription = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
        return view("admin.subscription.resume")
            ->with('onGracePeriode', $onGracePeriode)
            ->with('finsouscription', $finsouscription);
    }

    public function resumeSubscription(Request $request)
    {
        $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
        $cancelled = Auth::user()->subscription('default')->canceled();
        if ($cancelled && $onGracePeriode) {
            Auth::user()->subscription('default')->resume();
            $result = Auth::user()->subscribed('default') ? true : false;
            if($result) {
                //Mail::to(Auth::user()->email)->send(new ConfirmationResumeSubscription());
            }
        } else {
            $result = false;
        }
        return back()->with(["result" => $result]);
    }

}
