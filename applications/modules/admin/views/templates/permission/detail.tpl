{include file='header.tpl'}
<table class="adminTable">
    <thead>
        <tr>
            <td colspan="4"><input type="button" value="Back" onclick="location.href=rootPath+'admin/permissions';"/></td>
        </tr>
    </thead>
    <thead>
        <tr>
            <td width="25%">CODE</td>
            <td>Description</td>
            <td width="1%">Status</td>
            <td width="1%">Delete</td>
        </tr>
    </thead>
    <tbody>
        {if count($objects)>0}
            {foreach from=$objects item=p}
                <tr>
                    <td>{$p.code}</td>
                    <td>{$p.realDescription}</td>
                    <td class="icon">
                        {if empty($p.permission_groupId)}
                            <a href="admin/permissions/activate/pg/{$details.permission_groupId}/po/{$p.realId}"><img src="styles/src/admin/inactive.png"></a>
                        {else}
                            <a href="admin/permissions/deactivate/pg/{$details.permission_groupId}/po/{$p.realId}"><img src="styles/src/admin/active.png"></a>
                        {/if}
                    </td>
                    <td class="icon">
                        <a href="admin/permissions/deleteobject/id/" onclick="if(!confirm('Confirm!')) return false;"><img src="styles/src/admin/delete.png" /></a>
                    </td>
                </tr>
             {/foreach}
         {else}
                <tr><td colspan="10">No objects. <a href="admin/permissions/addobject">Maby add?</a></td></tr>
         {/if}
    </tbody>
</table>

<h2>Users in this group.</h2>
<table class="adminTable">
    {if count($userAvailable)>0}
        <thead>
            <tr>
                <td colspan="10">
                    <form method="post" action="admin/permissions/adduser/pg/{$details.permission_groupId}">
                        Add user to this group: 
                        <select name="userId" style="width:auto;">
                            <option disabled selected>Select user</option>
                            {foreach from=$userAvailable item=l}
                                <option value="{$l.userId}">{$l.name}</option>
                            {/foreach}
                        </select>
                        <input type="submit" value="Add" />
                    </form>
                </td>
            </tr>
        </thead>
    {/if}
    {if count($users)>0}
        <thead>
            <tr>
                <td>Email</td>
                <td>First name</td>
                <td>Last name</td>
                <td>Middle name</td>
                <td>Date added</td>
                <td width="1%">Delete</td>
            </tr>
        </thead>
        <tbody>
            {foreach from=$users item=u}
                <tr>
                    <td><a class="look" href="admin/user/view/id/{$u.userId}">{$u.email}</a></td>
                    <td>{$u.firstName}</td>
                    <td>{$u.lastName}</td>
                    <td>{$u.middleName}</td>
                    <td>{$u.dateAdded}</td>
                    <td class="icon">
                        <a href="admin/permissions/deleteuser/id/{$u.permission_group_userId}/pg/{$details.permission_groupId}" onclick="if(!confirm('Confirm')) return false;"><img src="styles/src/admin/delete.png" /></a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    {/if}
</table>

{include file='footer.tpl'}