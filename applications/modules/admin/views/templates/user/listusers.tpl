{include file = 'header.tpl'}
<div class="span-19 prepend-top last">


    {if !empty($message)}
    <div class="notice span-18">
        {$message}
    </div>
    {/if}

    <div class="span-19 append-bottom last">
        <form id="article-filter" action="#" method="post">
                 <select id="filter-approved" name="approved" onchange="location.href = '{$rootPath}admin/user/index' + $('#filter-approved')[0].value;">
                <option value="" {if empty($filter)}selected{/if}>All</option>
                <option value="/filter/1" {if $filter == '1'}selected{/if}>Active</option>
                <option value="/filter/0" {if $filter == '0'}selected{/if}>Inactive</option>
                </select>
        </form>
    </div>
    <table class="adminTable">
        <thead>
            <tr>
                <td>Login</td>
                <td>Email</td>
                <td width="1%">Permissions</td>
                <td width="1%">Approve</td>
                <td width="1%">Edit</td>
                <td width="1%">Delete</td>
            </tr>
        </thead>

    {if !empty($users.data)}
        {foreach from = $users.data item = n}
        <tr>
            <td>
                <a class="look" href="admin/user/view/id/{$n.userId}">{$n.firstName} {$n.lastName}</a>
            </td>
            <td>
                <a href="mailto:{$n.email}" title="Mail to This User">{$n.email}</a>
            </td>
            <td align="center">
                <a href="admin/permission/set/id/{$n.userId}" title="Set permissions">
                    <img src="images/icons/padlock.gif" alt="Set permissions" />
                </a>
            </td>
            <td align="center">
                {if $n.approved == 1}
                <a href="admin/user/disapprove/id/{$n.userId}" title="Deactivate user">
                    <img src="styles/src/admin/active.png" alt="Active" />
                </a>
                {else}
                <a href="admin/user/approve/id/{$n.userId}" title="Activate User">
                    <img src="styles/src/admin/inactive.png" alt="Not Active" />
                </a>
                {/if}
            </td>
            <td align="center">
                <a href="admin/user/edit/id/{$n.userId}" title="Edit">
                    <img src="styles/src/admin/edit.png" alt="Edit" />
                </a>
            </td>
            <td align="center">
                <a href="admin/user/delete/id/{$n.userId}" onclick="return confirm('Please, confirm delete')" title="Delete">
                    <img src="styles/src/admin/delete.png" alt="Delete" />
                </a>
            </td>
        </tr>
        {/foreach}
        <tr><td colspan="10">{$paging}</td></tr>
        {else}
        <tr><td colspan="10">No registered users</td></tr>
        {/if}
    </table>
    

</div>
{include file = 'footer.tpl'}