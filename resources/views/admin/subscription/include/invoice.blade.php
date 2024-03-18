<div class="card">
    <div class="card-header">
        <h5 class="card-title">Mes factures</h5>
    </div>
    <div class="card-body">

        <table class="table table-striped">
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                    <td>{{ $invoice->total() }}</td>
                    <td><a href="{{ route('admin.subscribe.invoice', ['invoice' => $invoice->id]) }}" target="_blank">Télécharger</a></td>
                    {{-- <td><a href="/user/invoice/{{ $invoice->id }}">Download</a></td> --}}
                </tr>
            @endforeach
        </table>
    </div>
</div>