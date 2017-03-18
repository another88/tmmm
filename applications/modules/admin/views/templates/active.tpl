{if $status == 1}
    <img style="cursor: pointer" 
         src="icon/active.png" 
         title="Disapproved" 
         onclick="approveRecord('{$address}', '{$id}', '{$fieldActive}');" 
     />
{else}
    <img style="cursor: pointer" 
         src="icon/inactive.png" 
         title="Approved" 
         onclick="approveRecord('{$address}', '{$id}', '{$fieldActive}');" 
     />    
{/if}