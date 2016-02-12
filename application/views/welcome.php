<p class="lead">
    <a href="/order/neworder" class="btn btn-large btn-primary">Start a new order</a>    
</p>
<p>Order summary:</p>
<table class="table">
    <tr>
        <th>Order #</th>
        <th>Date/Time</th>
        <th>Amount</th>
    </tr>
    {orders}
    <tr>
        <td>{num}</td>
        <td>{datetime}</td>
        <td>{amount}</td>
    </tr>
    {/orders}
</table>
