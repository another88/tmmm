{include file='header.tpl'}

<div class="contentInner">
{*    <div class="contentInnerLeft">*}       
        <div id="productBlock_{$p.productId}" class="productPageImage" id="productImage">
            <a href="images/product/{$p.productId}/{$p.imageOriginal}" class="imageFancy" rel="group">
                <img src="images/product/{$p.productId}/{$p.imageBig}" alt="{$p.metaTitle} Ace Hookah" title="{$p.metaTitle} Ace Hookah" />
            </a>
            <div class="clr"></div>
        </div>
        <div class="productPageText">
            <h1>{$pageTitle}</h1>
            <div class="clr"></div>              
            {$p.description}
            <div class="clr"></div>
            <div class="productDelLink">
                Ознакомиться с условиями оплаты и доставки Вы можете 
                на странице <a href="content/pay_delivery.html" target="_blank">Оплата и Доставка</a>.
            </div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
        {if count($productImages.data)>0}
            <div class="productPageImageSmall">
                {foreach from=$productImages.data item=pi name=iter}
                    <div class="productSmallImage" 
                         {if $smarty.foreach.iter.iteration is div by 3}style="margin-right: 0;"{/if}>
                        <a href="images/product/{$p.productId}/{$pi.imageOriginal}" class="imageFancy" rel="group">
                            <img src="images/product/{$p.productId}/{$pi.imageSmall}" width="75px"/>
                        </a>
                    </div>
                    {if $smarty.foreach.iter.iteration is div by 3}
                        <div class="clr"></div>
                    {/if}                     
                {/foreach}
                <div class="clr"></div>
            </div>
        {/if}
        <div class="productBuyButtons">
            <div class="toCartButtonOnProductPage analiticsToCartButton" onclick="toCart('{$p.productId}', true);">в корзину заказа</div>            
            <div class="onClickOrderOnProductPage" onclick="openModalBuyClick({$p.productId});">Купить в один клик</div> 
            <div class="amountBlock">
                <input type="text" value="1" id="productAmount" name="amount" onblur="changeAmountBlur($(this), false);" />
                <div class="amountChange">
                    <div class="amountUp" title="Больше" onclick="changeAmount('up', $(this), false);"></div>
                    <div class="clr"></div> 
                    <div class="amountDown" title="Меньше" onclick="changeAmount('down', $(this), false);"></div>
                    <div class="clr"></div> 
                </div>
                <div class="clr"></div> 
            </div>  
            <div class="productPrice">{$p.price} руб</div>
            <div class="clr"></div>
            <div class="productPageTextShare">
                <div class="share42init"
                     data-url="http://ace-hookah.com/product/{$p.url}.html"
                     data-title="{$p.title}"
                     data-description="{$p.description}"
                     data-image="http://ace-hookah.com/images/product/{$p.productId}/{$p.imageSmall}"
                ></div>         
                {literal}
                    <script type="text/javascript" src="share42/share42.js"></script>
                {/literal}   
            </div>     
            <div class="clr"></div>
        </div>        
        {include file='on_click.tpl'}
        <div class="clr"></div> 
{*        <div id="commentBlock">
            <input type="hidden" name="productId" value="{$p.productId}" />
            <div class="commentTitle">Комментарии к товару</div>
            <div class="clr"></div>
            {if count($productComment.data)>0}
                {foreach from=$productComment.data item=pc}
                    <div class="productCommentItem">
                        <div class="productCommentName">{$pc.name}</div>
                        <div class="productCommentDate">{$pc.dateAdded}</div>
                        <div class="clr"></div>
                        {$pc.comment}
                        <div class="clr"></div>
                    </div>
                {/foreach}
                <div class="clr"></div>
            {/if}
            <div class="addCommentBlock">
                <div class="commentInputTitle">
                    Ваше Имя<span class="redColor">*</span>
                </div>
                <div class="commentInputField">
                    <input type="text" name="name" class="popupInp" content-type="text" valid="1" 
                           {if isset($smarty.session.user)}value="{$smarty.session.user.firstName} {$smarty.session.user.lastName}"{/if}/>         
                </div>          
                <div class="clr" style="margin-bottom: 5px;"></div>
                <div class="commentInputTitle">
                    Комментарий<span class="redColor">*</span>
                </div>
                <div class="commentInputFieldBig">
                    <textarea class="commentTextarea" name="comment" content-type="text" valid="1"></textarea>         
                </div>          
                <div class="clr" style="margin-bottom: 5px;"></div> 
                <div class="commentInputTitle"></div>
                <div class="commentInputFieldBig">
                    <div class="commentButton" onclick="addComment();">Оставить комментарий</div>
                    <div id="comment_message"></div>
                </div> 
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>*}     
{*    </div>
    <div class="contentInnerRight">
        {include file='right_side.tpl'}
    </div>
    <div class="clr"></div>*}
</div>

{include file='footer.tpl'}