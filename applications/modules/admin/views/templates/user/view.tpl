{include file = 'header.tpl'}
<div class="span-19 prepend-top append-bottom last">
    <div class="span-19 last append-bottom">
        <div class="span-14">
            <h3>
                {$user.firstName}&nbsp;{$user.lastName}
            </h3>
        </div>
    </div>
    
    <div class="span-19 last">
        <div class="span-10">
            <span class="loud-bold">Login: </span>{$user.login}<br />
            <span class="loud-bold">Email: </span>{$user.email}<br />
            <span class="loud-bold">Registration date: </span>{$user.dateAdded|date_format:"%d-%m-%Y"}<br />
            <span class="loud-bold">Name: </span>{$user.name}<br />
        </div>
        <div class="span-9 last">
            <div class="span-9 last">
                <span class="loud-bold">Avatar: </span><br />
                {if !empty($user.image)}
                <img src="images/user/{$user.image}" alt="avatar" />
                {else}
                <img src="styles/images/noimg.png" alt="no avatar" />
                {/if}
            </div>
        </div>
    </div>
</div>

{include file = 'footer.tpl'}