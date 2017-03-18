{include file='header.tpl'}
<table class="adminTable">
    <thead>
        <tr>
            <td colspan="4">
                <input type="button" value="Add group" onclick="location.href=rootPath+'admin/permissions/addgroup';"/>
                <input type="button" value="Add new object" onclick="location.href=rootPath+'admin/permissions/addobject';"/>
            </td>
        </tr>
    </thead>
    <thead>
        <tr>
            <td width="25%">Title</td>
            <td>Description</td>
            <td width="1%"><nobr>Objects/Users</nobr></td>
            <td width="1%">Deleted</td>
        </tr>
    </thead>
    <tbody>
        {if count($groups.data) > 0}
            {foreach from=$groups.data item=group}
                <tr>
                    <td>{$group.title}</td>
                    <td>{$group.description}</td>
                    <td class="icon"><a href="admin/permissions/detail/pg/{$group.permission_groupId}">
                            <img src="icon/padlock.gif" alt="Rules" />
                        </a></td>
                    <td class="icon">
                        <a href="admin/permissions/deletegroup/pg/{$group.permission_groupId}" onclick="if(!confirm('Confirm delete!')) return false;">
                            <img src="icon/delete.png" />
                        </a>
                    </td>
                </tr>
            {/foreach}
        {else}
            <tr><td colspan="10">No groups. <a href="admin/permissions/addgroup">Maby create?</a></td></tr>
        {/if}
    </tbody>
</table>


{include file='footer.tpl'}