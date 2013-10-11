<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main1'); ?>
<div id="container">
    <div id="content">
        <?= $content ?>
    </div><!-- #content-->
</div><!-- #container-->

<aside id="sideRight"  style="overflow-y: scroll">
    <?php $this->widget('application.widgets.FeedWIdget'); ?>
</aside><!-- #sideRight -->
<!-- End: MAIN CONTENT -->
<?php $this->endContent(); ?>