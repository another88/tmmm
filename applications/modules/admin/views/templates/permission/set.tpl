{include file='header.tpl'}
<table class="adminTable">
    {if count($groupsAvailable)>0}
        <thead>
            <tr>
                <td colspan="10">
                    <form method="post" action="admin/permissions/addgrouptouser/id/{$userId}">
                        Добавить Пользователю: 
                        <select name="permission_groupId" style="width:auto;">
                            <option disabled selected>Выбирите группу</option>
                            {foreach from=$groupsAvailable item=l}
                                <option value="{$l.permission_groupId}">{$l.title}</option>
                            {/foreach}
                        </select>
                        <input type="submit" value="Добавить" />
                    </form>
                </td>
            </tr>
        </thead>
    {/if}
    <thead>
        <tr>
            <td width="25%">Название</td>
            <td>Описание</td>
            <td width="1%">Удалить</td>
        </tr>
    </thead>
    <tbody>
        {if count($groups) > 0}
            {foreach from=$groups item=group}
                <tr>
                    <td>{$group.title}</td>
                    <td>{$group.description}</td>
                    <td class="icon">
                        <a href="admin/permissions/deletegroupfromuser/pg/{$group.permission_group_userId}/uid/{$userId}">
                            <img src="icon/delete.png" />
                        </a>
                    </td>
                </tr>
            {/foreach}
        {else}
            <tr><td colspan="10">Нет групп</td></tr>
        {/if}
    </tbody>
</table>


{include file='footer.tpl'}