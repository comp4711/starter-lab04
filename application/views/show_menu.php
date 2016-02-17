<p class="lead">
    Click on a menu item below to add it to your order, or 
    <a href="/order/checkout/{order_num}" class="btn btn-primary">Checkout</a>
</p>

<div class="row text-center">
    <div class="span3">
        {meals}
        <a href="/order/add/{order_num}/{code}">
            <img src="/assets/images/{picture}" title="{description}"/>            
        </a>
        <br/>{name} ({price})<br/>
        {/meals}
    </div>
    <div class="span3 offset1">
        {drinks}
        <a href="/order/add/{order_num}/{code}">
            <img src="/assets/images/{picture}" title="{description}"/>            
        </a>
        <br/>{name} ({price})<br/>
        {/drinks}
    </div>
    <div class="span3 offset1">
        {sweets}
        <a href="/order/add/{order_num}/{code}">
            <img src="/assets/images/{picture}" title="{description}"/>            
        </a>
        <br/>{name} ({price})<br/>
        {/sweets}
    </div>
</div>