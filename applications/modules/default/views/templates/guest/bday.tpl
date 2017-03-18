<div class="guestCardBlock insideBlockG" id="gb_{$gi.guestId}">
    <div class="guestPhoto insideBlockP">
        <img src="images/guest/{$gi.guestId}/{$gi.imageBig}" 
             style="max-width: 360px; max-height: 360px;" 
             onmouseover="" onmouseout="" onclick="guestCardClickBday({$gi.guestId});"/>
        <div class="clear"></div>
    </div>
    <div class="guestDesc">
        <div class="guestDescTitle">ID:</div>
        <div class="guestDescInput">{$gi.guestId}</div>
        <div class="clear"></div>                
        <div class="guestDescTitle">Карта номер:</div>
        <div class="guestDescInput guestCardNumber">{$gi.cardNumber}</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Имя:</div>
        <div class="guestDescInput guestName">{$gi.name} {$gi.secondName} {$gi.thirdName}</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Дата рождения:</div>
        <div class="guestDescInput guestBirth">{$gi.birthday}</div>                
        <div class="clear"></div>
        <div class="guestDescTitle">Телефон:</div>
        <div class="guestDescInput guestPhone">{$gi.phone}</div>
        <div class="clear"></div>                
        <div class="guestDescTitle">E-mail:</div>
        <div class="guestDescInput guestEmail">{$gi.email}</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Страна:</div>
        <div class="guestDescInput guestCountry">{$gi.country}</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Город:</div>
        <div class="guestDescInput guestCity">{$gi.city}</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Баллов:</div>
        <div class="guestDescInput">{$gi.points}</div>
        <div class="clear"></div>
    </div>                    
    <div class="clear"></div>
</div>