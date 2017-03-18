<p>Congratulations, {$user.firstName}&nbsp;{$user.lastName}!</p>
<p>
    You have become an expert in categories:
</p>
<ul>
    {foreach from = $expertCategories item = ec}
    <li>{$ec.title}</li>
    {/foreach}
</ul>
<p>Since that moment you'll recieve questoins on your specialization.</p>
<p>
    Best wishes,<br />
    <a href="{$rootPath}">{$rootPath}</a>
</p>