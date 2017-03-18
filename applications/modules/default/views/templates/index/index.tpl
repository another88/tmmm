{include file='header.tpl'}

<div class="inMainProduct">
    {foreach from=$mainProduct.data item=p name=iter}
        <div id="productBlock_{$p.productId}" {if $smarty.foreach.iter.iteration is div by 3}class="productBlockMainLast"{else}class="productBlockMain"{/if}>
            <div class="mainProductImage" 
                 style="background:transparent url('images/product/{$p.productId}/{$p.imageBig}') no-repeat 0 0;"
                 onclick="redirect('product/{$p.url}.html');">
                <div class="priceAngle">
                    <span class="anglePriceVal">{$p.price}</span><br/>рублей
                </div>
                <div class="clr"></div>
                <div class="mainProductTitle"><a href="product/{$p.url}.html">{$p.title}</a></div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="mainProductBuy analiticsToCartButton" onclick="toCart('{$p.productId}', true);">В корзину заказа</div>
            <div class="clr"></div>
            <div class="mainProductBuy" onclick="openModalBuyClick({$p.productId});">Купить в один клик</div>                    
            <div class="clr"></div>
            {include file='on_click.tpl'}            
        </div>
{*        {if $smarty.foreach.iter.iteration is div by 3}
            <div class="clr"></div>
        {/if}*}
    {/foreach}
    <div class="clr"></div>
    <h1>{$meta.title}</h1>
    <div class="clr"></div>
    {if !empty($content.description)}
        <div class="mainText">{$content.description}</div>
        <div class="clr"></div> 
    {/if}
</div>
<div class="clr"></div>
<div class="whyWe">
    <div class="whyWeInner">
        <div class="whyWeTitle">наши преимущества</div>
        <div class="clr"></div>
        <div class="whyWeImages"></div>
        <div class="clr"></div>
        <div class="whyWeBlock">
            <div class="whyWeBlockTitle">Приятные цены</div>
            <div class="clr"></div>
            <div class="whyWeText">
                Мы не перепродавцы, мы производители, а поэтому наши цены ниже.
                С нами выгодно и розничным и оптовым клиентам!
            </div>
            <div class="clr"></div>
        </div>
        <div class="whyWeBlock">
            <div class="whyWeBlockTitle">Качество</div>
            <div class="clr"></div>
            <div class="whyWeText">
                Наши кальяны успешно прошли проверку путем ежедневной эксплуатации
                в сетях заведений города.  
            </div>            
            <div class="clr"></div>
        </div>
        <div class="whyWeBlock last_menu_block">
            <div class="whyWeBlockTitle">Доверие</div>
            <div class="clr"></div>
            <div class="whyWeText">
                Нас рекомендуют своим близким и друзьям. 
                А это говорит о высоком уровне доверия к нам.
            </div>            
            <div class="clr"></div>
        </div>        
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>

{include file='footer.tpl'}