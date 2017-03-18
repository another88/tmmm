{include file='header.tpl'}

<input type="hidden" name="jsonData" value='{$json}' />

<div class="contentInner">
    <div class="constructorText">
        <h1>{$pageTitle}</h1>
        <div class="clr"></div>          
        {$content.description}
        <div class="constructorPageTextShare">
            <div class="share42init"
                 data-url="http://ace-hookah.com/constructor"
                 data-title="{$content.title}"
                 data-description="{$content.description}"
            ></div>         
            {literal}
                <script type="text/javascript" src="share42/share42.js"></script>
            {/literal}   
        </div>           
        <div class="clr"></div> 
    </div>     
{*    <div class="clr"></div>
    <div class="constructorMenu">
        
        <div class="clr"></div>
    </div>*}
    <div class="clr"></div><br/>
    <div class="constructorLeft" id="constructor_top">
        <input type="hidden" name="shaxta" value="0" />
        <input type="hidden" name="kolba" value="0" />
        <input type="hidden" name="trybka" value="0" />
        <input type="hidden" name="bowl" value="0" />
        <input type="hidden" name="bludce" value="0" />
        <input type="hidden" name="shipci" value="0" />
        <div id="productBlock_1000" class="conLeftPart">
            <div class="conShaxta conElement conMain_shaxta" id="shaxta" elementprice="0" onclick="setChoiceElement('shaxta');">
                <img src="i/shaxta.png" />
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="consClearBlockButton" id="clearButton_shaxta" onclick="cleaBlock('shaxta');">
                Очистить блок
            </div>            
            <div class="clr"></div>
            <div class="conKolba conElement conMain_kolba" id="kolba" elementprice="0" onclick="setChoiceElement('kolba');">
                <img src="i/kolba.png" />
            </div>     
            <div class="clr"></div>
            <div class="consClearBlockButton" id="clearButton_kolba" onclick="cleaBlock('kolba');">
                Очистить блок
            </div>              
            <div class="clr"></div>
        </div>
        <div class="consRightPart">
            <div class="conTrybka conElement conMain_trybka" id="trybka" elementprice="0" onclick="setChoiceElement('trybka');">
                <img src="i/trybka.png" />
            </div>
            <div class="clr"></div>
            <div class="consClearBlockButton ccbbtr" id="clearButton_trybka" onclick="cleaBlock('trybka');">
                Очистить блок
            </div>              
            <div class="clr"></div>    
{*            <div class="addedSpace"></div>
            <div class="clr"></div>  *}
            <div class="bowlMainBlock">
                <div class="conBowl conElement conMain_bowl" id="bowl" elementprice="0" onclick="setChoiceElement('bowl');">
                    <img src="i/bowl.png" />
                </div>
                <div class="clr"></div>   
                <div class="consClearBlockButton ccbbb" id="clearButton_bowl" onclick="cleaBlock('bowl');">
                    Очистить блок
                </div>              
                <div class="clr"></div>                  
            </div>
            <div class="bludceMainBlock">
                <div class="conBludce conElement conMain_bludce" id="bludce" elementprice="0" onclick="setChoiceElement('bludce');">
                    <img src="i/bludce.png" />
                </div>    
                <div class="clr"></div>   
                <div class="consClearBlockButton ccbbbl" id="clearButton_bludce" onclick="cleaBlock('bludce');">
                    Очистить блок
                </div>              
                <div class="clr"></div>                
            </div>
            <div class="clr"></div>   
            <div class="shipciMainBlock">
                <div class="conShipci conElement conMain_shipci" id="shipci" elementprice="0" onclick="setChoiceElement('shipci');">
                    <img src="i/shipci.png" />
                </div>   
                <div class="clr"></div>   
                <div class="consClearBlockButton ccbbbs" id="clearButton_shipci" onclick="cleaBlock('shipci');">
                    Очистить блок
                </div>              
                <div class="clr"></div>                
            </div>                
            <div class="contrPriceBlock">
                <strong>Цена:</strong> <span class="consPrice">0</span> руб.
                <div class="clr"></div>
                <div class="consDiscount"></div>
                <div class="clr"></div>
                <div class="contrClearButton" onclick="constructorClear();">Очистить все</div>
                <div class="clr"></div>
                <div class="contrCartButton" onclick="toCartConstr();">В корзину</div> 
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        </div>        
    </div>
{*     <div class="constructorRight">
        {if count($constructorBase.data)>0}
            <div class="constructorBaseContent">
                {include file='constructor/page.tpl'}
            </div>     
            <div class="clr"></div>
        {/if}
       <div class="constructorRightContent">
            <input type="hidden" name="jsonData" value='{$json}' />
            <div class="rightTitleConstr">Выбор элемента<span class="clearButtonChoice" onclick="constructorClear();">Очистить все</span></div>
            <div class="clr"></div>
            <div class="constructorRightItem"></div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>  *}      
    <div class="clr"></div>
</div>
    
<div id="consModals"></div>

{include file='footer.tpl'}