<?php

namespace PHPMaker2021\lpdpdss;

// Page object
$GradeList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fgradelist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fgradelist = currentForm = new ew.Form("fgradelist", "list");
    fgradelist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fgradelist");
});
var fgradelistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fgradelistsrch = currentSearchForm = new ew.Form("fgradelistsrch");

    // Dynamic selection lists

    // Filters
    fgradelistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fgradelistsrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> grade">
<form name="fgradelist" id="fgradelist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="grade">
<div id="gmp_grade" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_gradelist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->awardee->Visible) { // awardee ?>
        <th data-name="awardee" class="<?= $Page->awardee->headerCellClass() ?>"><div id="elh_grade_awardee" class="grade_awardee"><?= $Page->renderSort($Page->awardee) ?></div></th>
<?php } ?>
<?php if ($Page->international->Visible) { // international ?>
        <th data-name="international" class="<?= $Page->international->headerCellClass() ?>"><div id="elh_grade_international" class="grade_international"><?= $Page->renderSort($Page->international) ?></div></th>
<?php } ?>
<?php if ($Page->national->Visible) { // national ?>
        <th data-name="national" class="<?= $Page->national->headerCellClass() ?>"><div id="elh_grade_national" class="grade_national"><?= $Page->renderSort($Page->national) ?></div></th>
<?php } ?>
<?php if ($Page->community->Visible) { // community ?>
        <th data-name="community" class="<?= $Page->community->headerCellClass() ?>"><div id="elh_grade_community" class="grade_community"><?= $Page->renderSort($Page->community) ?></div></th>
<?php } ?>
<?php if ($Page->experience->Visible) { // experience ?>
        <th data-name="experience" class="<?= $Page->experience->headerCellClass() ?>"><div id="elh_grade_experience" class="grade_experience"><?= $Page->renderSort($Page->experience) ?></div></th>
<?php } ?>
<?php if ($Page->gpa->Visible) { // gpa ?>
        <th data-name="gpa" class="<?= $Page->gpa->headerCellClass() ?>"><div id="elh_grade_gpa" class="grade_gpa"><?= $Page->renderSort($Page->gpa) ?></div></th>
<?php } ?>
<?php if ($Page->scolastic->Visible) { // scolastic ?>
        <th data-name="scolastic" class="<?= $Page->scolastic->headerCellClass() ?>"><div id="elh_grade_scolastic" class="grade_scolastic"><?= $Page->renderSort($Page->scolastic) ?></div></th>
<?php } ?>
<?php if ($Page->lgd->Visible) { // lgd ?>
        <th data-name="lgd" class="<?= $Page->lgd->headerCellClass() ?>"><div id="elh_grade_lgd" class="grade_lgd"><?= $Page->renderSort($Page->lgd) ?></div></th>
<?php } ?>
<?php if ($Page->interview->Visible) { // interview ?>
        <th data-name="interview" class="<?= $Page->interview->headerCellClass() ?>"><div id="elh_grade_interview" class="grade_interview"><?= $Page->renderSort($Page->interview) ?></div></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th data-name="total" class="<?= $Page->total->headerCellClass() ?>"><div id="elh_grade_total" class="grade_total"><?= $Page->renderSort($Page->total) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_grade", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->awardee->Visible) { // awardee ?>
        <td data-name="awardee" <?= $Page->awardee->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_awardee">
<span<?= $Page->awardee->viewAttributes() ?>>
<?= $Page->awardee->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->international->Visible) { // international ?>
        <td data-name="international" <?= $Page->international->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_international">
<span<?= $Page->international->viewAttributes() ?>>
<?= $Page->international->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->national->Visible) { // national ?>
        <td data-name="national" <?= $Page->national->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_national">
<span<?= $Page->national->viewAttributes() ?>>
<?= $Page->national->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->community->Visible) { // community ?>
        <td data-name="community" <?= $Page->community->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_community">
<span<?= $Page->community->viewAttributes() ?>>
<?= $Page->community->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->experience->Visible) { // experience ?>
        <td data-name="experience" <?= $Page->experience->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_experience">
<span<?= $Page->experience->viewAttributes() ?>>
<?= $Page->experience->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gpa->Visible) { // gpa ?>
        <td data-name="gpa" <?= $Page->gpa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_gpa">
<span<?= $Page->gpa->viewAttributes() ?>>
<?= $Page->gpa->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->scolastic->Visible) { // scolastic ?>
        <td data-name="scolastic" <?= $Page->scolastic->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_scolastic">
<span<?= $Page->scolastic->viewAttributes() ?>>
<?= $Page->scolastic->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lgd->Visible) { // lgd ?>
        <td data-name="lgd" <?= $Page->lgd->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_lgd">
<span<?= $Page->lgd->viewAttributes() ?>>
<?= $Page->lgd->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->interview->Visible) { // interview ?>
        <td data-name="interview" <?= $Page->interview->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_interview">
<span<?= $Page->interview->viewAttributes() ?>>
<?= $Page->interview->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total->Visible) { // total ?>
        <td data-name="total" <?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("grade");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
