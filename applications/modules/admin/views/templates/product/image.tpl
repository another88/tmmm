{include file='header.tpl'}
<table class="adminTable">
    <tr>
        <td colspan="2">Изображения:</td>
    </tr>
    <tr>
        <td colspan="2">
            {if count($image.data)>0}
                {foreach from = $image.data item = i}
                    <div class="productImages">
                        <div  class="img">
                            <img src="images/product/{$i.productId}/{$i.imageSmall}" />
                        </div>
                        <div>
                            <a class="delete" href="admin/product/imagedelete/id/{$i.productImageId}" onclick="return confirm('Удалить?')">
                                Удалить
                            </a>
                        </div>
                    </div>
                {/foreach}
            {else}
                No photo
            {/if}
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <form id="article" action="admin/product/image/id/{$product.productId}" method="post" enctype="multipart/form-data">
                <table border="1">
                    <tbody>
                        <tr>
                            <td>Выбирите фото:</td>
                            <td><input type="file" class="file" name="imageOriginal" id="imageOriginal" value="" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="button">Загрузить</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </td>
    </tr>
</table>
{include file='footer.tpl'}