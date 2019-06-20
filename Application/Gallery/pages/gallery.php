<?php $html_sort = $page["html_sort"]; ?>
<div class="container-gallery">
    <a class="button" href="/add">Добавить</a>
    <div class="gallery">
        <?php foreach ($page["items"] as $item): ?>
        <div class="item">
            <img src="<?php echo $item["src"]; ?>">
            <div class="info">
                Likes: <?php echo $item["likes"]; ?>,
                Comments: <?php echo $item["comments"]; ?>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <div class="pagination">
    <?php for ($i = 1; $i <= $page["total_pages"]; $i++): ?>
        <a href="<?php echo "/gallery?page=$i&$html_sort"?>"
        <?php echo ($i == $page["page"] ? 'class="active"' : "") ?>
        >
            <?php echo $i ?>
        </a>
    <?php endfor; ?>
    </div>
</div>