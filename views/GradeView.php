<?php

namespace PHPMaker2021\lpdpdss;

// Page object
$GradeView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fgradeview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fgradeview = currentForm = new ew.Form("fgradeview", "view");
    loadjs.done("fgradeview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.grade) ew.vars.tables.grade = <?= JsonEncode(GetClientVar("tables", "grade")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fgradeview" id="fgradeview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="grade">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grade_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_grade_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->awardee->Visible) { // awardee ?>
    <tr id="r_awardee">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grade_awardee"><?= $Page->awardee->caption() ?></span></td>
        <td data-name="awardee" <?= $Page->awardee->cellAttributes() ?>>
<span id="el_grade_awardee">
<span<?= $Page->awardee->viewAttributes() ?>>
<?= $Page->awardee->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->international->Visible) { // international ?>
    <tr id="r_international">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grade_international"><?= $Page->international->caption() ?></span></td>
        <td data-name="international" <?= $Page->international->cellAttributes() ?>>
<span id="el_grade_international">
<span<?= $Page->international->viewAttributes() ?>>
<?= $Page->international->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->national->Visible) { // national ?>
    <tr id="r_national">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grade_national"><?= $Page->national->caption() ?></span></td>
        <td data-name="national" <?= $Page->national->cellAttributes() ?>>
<span id="el_grade_national">
<span<?= $Page->national->viewAttributes() ?>>
<?= $Page->national->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->community->Visible) { // community ?>
    <tr id="r_community">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grade_community"><?= $Page->community->caption() ?></span></td>
        <td data-name="community" <?= $Page->community->cellAttributes() ?>>
<span id="el_grade_community">
<span<?= $Page->community->viewAttributes() ?>>
<?= $Page->community->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->experience->Visible) { // experience ?>
    <tr id="r_experience">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grade_experience"><?= $Page->experience->caption() ?></span></td>
        <td data-name="experience" <?= $Page->experience->cellAttributes() ?>>
<span id="el_grade_experience">
<span<?= $Page->experience->viewAttributes() ?>>
<?= $Page->experience->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gpa->Visible) { // gpa ?>
    <tr id="r_gpa">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grade_gpa"><?= $Page->gpa->caption() ?></span></td>
        <td data-name="gpa" <?= $Page->gpa->cellAttributes() ?>>
<span id="el_grade_gpa">
<span<?= $Page->gpa->viewAttributes() ?>>
<?= $Page->gpa->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->scolastic->Visible) { // scolastic ?>
    <tr id="r_scolastic">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grade_scolastic"><?= $Page->scolastic->caption() ?></span></td>
        <td data-name="scolastic" <?= $Page->scolastic->cellAttributes() ?>>
<span id="el_grade_scolastic">
<span<?= $Page->scolastic->viewAttributes() ?>>
<?= $Page->scolastic->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lgd->Visible) { // lgd ?>
    <tr id="r_lgd">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grade_lgd"><?= $Page->lgd->caption() ?></span></td>
        <td data-name="lgd" <?= $Page->lgd->cellAttributes() ?>>
<span id="el_grade_lgd">
<span<?= $Page->lgd->viewAttributes() ?>>
<?= $Page->lgd->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->interview->Visible) { // interview ?>
    <tr id="r_interview">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grade_interview"><?= $Page->interview->caption() ?></span></td>
        <td data-name="interview" <?= $Page->interview->cellAttributes() ?>>
<span id="el_grade_interview">
<span<?= $Page->interview->viewAttributes() ?>>
<?= $Page->interview->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <tr id="r_total">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grade_total"><?= $Page->total->caption() ?></span></td>
        <td data-name="total" <?= $Page->total->cellAttributes() ?>>
<span id="el_grade_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
