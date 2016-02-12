<p class="lead">
    Order # {order_num} for {total}
</p>
{items}
<div class="row">
    {quantity}
    {code}
</div>
{/items}
<div class="row">
    <a href="/order/commit/{order_num}" class="btn btn-large btn-success {okornot}">Proceed</a>
    <a href="/order/display_menu/{order_num}" class="btn btn-large btn-primary">Keep shopping</a>
    <a href="/order/cancel/{order_num}" class="btn btn-large btn-danger">Forget about it</a>
</div>