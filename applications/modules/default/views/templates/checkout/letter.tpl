<!DOCTYPE html>
<html>
    <body style="margin: 0; padding: 0; font-size: 12px; color: black; line-height: 20px; background-color: white; width: 825px;">
        <div style="width: 825px; height: 100px; background-color: black; color: white;">
            <div style="background:transparent url('http://ace-hookah.com/i/logo.png') no-repeat 0 0; height: 70px; width: 285px; float: left; margin-top: 20px; margin-right: 25px;"></div>
            <div style="float: left; width: 492px; margin-top: 40px;">
                <div style="background:transparent url('http://ace-hookah.com/i/header_divider.png') no-repeat 0 0; height: 30px; width: 1px; float: left;"></div>
                <div style="float: left; width: 435px; text-transform: uppercase; margin: 0 27px; color: white; margin-top: -4px;">
                    Деревянные шахты, моющиеся шланги, оригинальные решения
                    <div style="color: white; float: left; width: 92px; margin-right: 72px;">
                        +7<span style="color: #ef9a20;">(978)</span>739-04-99
                    </div>
                    <div style="color: white; float: left; width: 92px; margin-right: 26px;">
                        +7<span style="color: #ef9a20;">(978)</span>719-98-87
                    </div> 
                    <div style="color: white; float: right; width: 111px;">
                        ace-<span style="color: #ef9a20;">hookah</span>.com
                    </div>                             
                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                </div>
                <div style="background:transparent url('http://ace-hookah.com/i/header_divider.png') no-repeat 0 0; height: 30px; width: 1px; float: left;"></div>
                <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
            </div>            
        </div>
        <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
        <div style="padding: 10px 12px; font-size: 13px; background-color: black; color: white; width: 801px;">
            {if isset($smarty.session.user) && !empty($smarty.session.user)}
                {$smarty.session.user.firstName} {$smarty.session.user.lastName},
            {/if}
            Благодарим за покупку на сайте <a href="http://ace-hookah.com" target="_blank" style="color: #EF9A20; text-decoration: underline; font-size: 14px;">ace-hookah.com</a>. 
            Номер вашего заказа <span style="color: #ef9a20;">43</span>.
            Наш менеджер свяжется с Вами в близжайшее время.
        </div>
        <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
        <table style="width: 825px; border: none; border-collapse: collapse;">
            <thead>
                <tr>
                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                        Картинка
                    </td>
                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                        Название
                    </td> 
                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                        Цена
                    </td>
                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                        Количество
                    </td>     
                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                        Стоимость позиции
                    </td> 
                </tr>
            </thead>
            <tbody>
                {foreach from=$cart item=c}
                    <tr>
                        <td style="padding: 10px; border: 2px solid black; text-align: center;" width="15%">
                            {if !empty($c.details.imageSmall)}
                                <img src="http://ace-hookah.com/images/product/{$c.details.productId}/{$c.details.imageSmall}" />
                            {/if}
                        </td>
                        <td style="padding: 10px; border: 2px solid black; text-align: left;" width="40%">
                            {if !isset($c.elements)}
                                <a href="http://ace-hookah.com/product/details/id/{$c.details.productId}" target="_blank" style="color: #EF9A20; text-decoration: underline; font-size: 14px;">{$c.details.title}</a>
                            {else}
                                <div style="float: left; width: 83px; margin-right: 2px;">
                                    <div style="width: 79px; height: 138px;" class="conShaxta conElement">
                                        <img width="79px" src="http://ace-hookah.com/images/consshaxta/7/w45X26fG.jpg">
                                    </div>
                                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                    <div style="width: 79px; height: 79px; margin-top: 2px;" class="conKolba conElement">
                                        <img width="79px" src="http://ace-hookah.com/images/conskolba/1/0ciKn9Wi.jpg">
                                    </div>
                                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>                                    
                                </div>
                                <div style="float: left; width: 113px;">
                                    <div style="width: 106px; height: 106px;">
                                        <img width="106px" src="http://ace-hookah.com/images/constrybka/2/Vla0lI7R.JPG">
                                    </div>
                                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                    <div style="margin-top: 2px; width: 50px; height: 50px; float: left; margin-right: 2px;">
                                        <img width="50px" src="http://ace-hookah.com/images/consbowl/1/wg9QfPJY.jpg">
                                    </div>
                                    <div style="width: 50px; height: 50px; margin-top: 2px; float: left;">
                                        <img width="50px" src="http://ace-hookah.com/images/consbludce/1/Ok2aHsaT.jpg">
                                    </div>
                                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                    <div style="width: 50px; height: 50px; margin-top: 2px;">
                                        <img width="50px" src="http://ace-hookah.com/images/consshipci/1/9npl8Rn7.jpg">
                                    </div>
                                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>                                   
                                </div>                               
                            {/if}
                        </td> 
                        <td style="padding: 10px; border: 2px solid black; text-align: center;" width="15%">
                            {$c.details.price} рублей
                        </td>
                        <td style="padding: 10px; border: 2px solid black; text-align: center;" width="10%">
                            {$c.amount}
                        </td>     
                        <td style="padding: 10px; border: 2px solid black; text-align: center;" width="20%">
                            {$c.allPrice} рублей
                        </td> 
                    </tr>
                {/foreach}
            </tbody>
        </table> 
        <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
        <div style="width: 825px; padding: 10px 0; background-color: black; color: white; font-size: 14px;">
            {if $smarty.session.cartPrice.discount}
                 <div style="padding: 10px 0; float: right; width: 250px;">
                     <div style="text-align: right; float: left; width: 160px; margin-right: 10px; font-weight: bold;">
                         Стоимость без скидки:
                     </div>
                     <div style="text-align: left; float: left; width: 80px; color: #ef9a20;">
                         {$smarty.session.cartPrice.totalProductsPrice} руб
                     </div>                    
                     <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                 </div>
                 <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                 <div style="padding: 10px 0; float: right; width: 250px;">
                     <div style="text-align: right; float: left; width: 160px; margin-right: 10px; font-weight: bold;">
                         Скидка:
                     </div>
                     <div style="text-align: left; float: left; width: 80px; color: #ef9a20;">
                         {$smarty.session.cartPrice.discount} руб
                     </div>                    
                     <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                 </div>
                 <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>  
             {/if}                
            <div style="padding: 10px 0; float: right; width: 250px;">
                <div style="text-align: right; float: left; width: 160px; margin-right: 10px; font-weight: bold;">
                    Стоимость заказа:
                </div>
                <div style="text-align: left; float: left; width: 80px; color: #ef9a20;">
                    {$smarty.session.cartPrice.orderPrice} руб
                </div>                    
                <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
            </div>
            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
        </div>        
        <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
    </body>
</html>