<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="col-sm">
                <div class="bg-gray p-3" style="border-radius: 8px;">
                    <table class="table table-bordered table-hover">
                        <thead style="background: #404040; color:white;">
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isEmpty())
                                <tr>
                                    <td colspan="6">
                                        <center>You have no orders placed yet.</center>
                                    </td>
                                </tr>
                            @else
                                @foreach ($orders as $order)
                                    <tr>
                                        <td data-column="Item">
                                            @if ($order->dishes->isEmpty())
                                                <div>No dishes found for this order.</div>
                                            @else
                                                @foreach ($order->dishes as $dish)
                                                    <div>
                                                        <strong>{{ $dish->name }}</strong> - Quantity:
                                                        {{ $dish->pivot->quantity }}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td data-column="Price">₱{{ number_format($order->total, 2) }}</td>
                                        <td data-column="Status">
                                            @php $status = $order->status; @endphp
                                            @if (!$status)
                                                <span class="text-info">
                                                    <span class="fa fa-bars" aria-hidden="true"></span> Dispatch
                                                </span>
                                            @elseif($status == 'pending')
                                                <span class="text-warning">
                                                    <span class="fa fa-cog fa-spin" aria-hidden="true"></span>
                                                    Preparing!
                                                </span>
                                            @elseif($status == 'processing')
                                                <span class="text-warning">
                                                    <span class="fa fa-cog fa-spin" aria-hidden="true"></span> On The
                                                    Way!
                                                </span>
                                            @elseif($status == 'delivered')
                                                <span class="text-success">
                                                    <span class="fa fa-check-circle" aria-hidden="true"></span>
                                                    Delivered
                                                </span>
                                            @elseif($status == 'rejected')
                                                <span class="text-danger">
                                                    <i class="fa fa-close"></i> Cancelled
                                                </span>
                                            @endif
                                        </td>
                                        <td data-column="Date">{{ $order->created_at }}</td>
                                        <td data-column="Action">
                                            <a href="{{ route('orders.delete', $order->id) }}"
                                                onclick="return confirm('Are you sure you want to cancel your order?');"
                                                class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                                                <i class="fa fa-trash-o" style="font-size:16px"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
