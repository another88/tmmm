{include file='header.tpl'}

<div class="contentInner">
    <div class="contentInnerLeft">
        <h1>{$pageTitle}</h1>
        <div class="clr"></div>          
        <div class="testimonial_button" onclick="openModalTestimonial();">Оставить отзыв</div>
        <div class="clr"></div>
        {if $testimonialAdded}
            <div class="testimonialSucces">Ваш отзыв успешно отправлен на модерацию! Спасибо!</div>
        {/if}
        <div class="clr"></div>
        {if count($testimonials.data)>0}
            {foreach from=$testimonials.data item=t}
                <div class="testimonialBlock">
                    {if !empty($t.imageMedium)}
                        <div class="testimonialImage">
                            <img src="images/testimonial/{$t.testimonialId}/{$t.imageMedium}" class="resizebleImg" />
                            <div class="clr"></div>
                        </div>
                    {/if}
                    <div class="testimonialDescription{if empty($t.imageMedium)} bigTestimonialDesc{/if}">
                        <div class="testimonialTitle">{$t.firstName} {$t.lastName}</div>
                        <div class="testimonialDate">{$t.dateAdded|date_format:"%d.%m.%Y %k:%M"}</div>
                        <div class="clr"></div>
                        <div class="testimonialEmailLink">{if !empty($t.vklink)}<a href="{$t.vklink}" target="_blank">{$t.vklink}</a>{/if}</div>
                        <div class="clr"></div>            
                        {$t.comment}         
                        <div class="clr"></div>                            
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            {/foreach}          
        {/if}
        {if count($testimonials.data)>3}
            <div class="testimonial_button" onclick="openModalTestimonial();">Оставить отзыв</div>
        {/if}
        {include file='popup_testimonial.tpl'} 
    </div>
{*    <div class="contentInnerRight">
        {include file='right_side.tpl'}
    </div>*}
    <div class="clr"></div>
</div>

{include file='footer.tpl'}