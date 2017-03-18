<?php /* Smarty version 2.6.19, created on 2017-03-18 01:19:53
         compiled from guest/loungeclose.tpl */ ?>
<style type="text/css">
<?php echo '
    head{
        visibility: hidden;
    }
    .tableProductTable{
        border-collapse: collapse;
        border: 1px solid black;    
        width: 250px;
    }
    .tableProductTable thead tr td{
        font-size: 12px;
        padding: 5px;
        border: 1px solid black;
    }
    .tableProductTable tbody tr td{
        padding: 5px;
        border: 1px solid black;
        font-size: 12px;
    }
    .clear {
        clear: both;
    }    
    .tableTotalPrice{
        margin: 10px 0;
        text-align: right;
        font-size: 13px;
    }    
    .tableInfo{
        font-size: 13px;
        margin-bottom: 10px;
    }
    .tableInfoBot{
        font-size: 12px;
        margin-top: 10px;   
        text-align: center;
    }
'; ?>

</style>

<div class="tableInfo">
    Кассовый день: <?php echo $this->_tpl_vars['dayDet']['currentDate']; ?>

    <div class="clear"></div>
    Открыта: <?php echo $this->_tpl_vars['dayDet']['openDate']; ?>

    <div class="clear"></div>
    Закрыта: <?php echo $this->_tpl_vars['dayDet']['closeDate']; ?>

    <div class="clear"></div>
</div>
<div class="clear"></div>
<table class="tableProductTable">
    <thead>
        <tr>
            <td>
                Общая касса
            </td>
            <td>
                Касса Бар
            </td>
            <td>
                Касса кальяны
            </td>
            <td>
                Баллами
            </td>            
            <td>
                Кол-ство кальянов
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php echo $this->_tpl_vars['dayDet']['totalSum']; ?>
 руб.
            </td>
            <td>
                <?php echo $this->_tpl_vars['dayDet']['barSum']; ?>
 руб.
            </td>
            <td>
                <?php echo $this->_tpl_vars['dayDet']['hookahSum']; ?>
 руб.
            </td>
            <td>
                <?php echo $this->_tpl_vars['dayDet']['pointSale']; ?>
 руб.
            </td>            
            <td>
                <?php echo $this->_tpl_vars['dayDet']['hookahCount']; ?>

            </td>                          
        </tr>
    </tbody>                
</table>       
<div class="clear"></div>

<script>
    window.print();
</script>