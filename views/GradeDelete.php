<?php

namespace PHPMaker2021\lpdpdss;

// Page object
$GradeDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fgradedelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fgradedelete = currentForm = new ew.Form("fgradedelete", "delete");
    loadjs.done("fgradedelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.grade) ew.vars.tables.grade = <?= JsonEncode(GetClientVar("tables", "grade")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fgradedelete" id="fgradedelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="grade">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->awardee->Visible) { // awardee ?>
        <th class="<?= $Page->awardee->headerCellClass() ?>"><span id="elh_grade_awardee" class="grade_awardee"><?= $Page->awardee->caption() ?></span></th>
<?php } ?>
<?php if ($Page->international->Visible) { // international ?>
        <th class="<?= $Page->international->headerCellClass() ?>"><span id="elh_grade_international" class="grade_international"><?= $Page->international->caption() ?></span></th>
<?php } ?>
<?php if ($Page->national->Visible) { // national ?>
        <th class="<?= $Page->national->headerCellClass() ?>"><span id="elh_grade_national" class="grade_national"><?= $Page->national->caption() ?></span></th>
<?php } ?>
<?php if ($Page->community->Visible) { // community ?>
        <th class="<?= $Page->community->headerCellClass() ?>"><span id="elh_grade_community" class="grade_community"><?= $Page->community->caption() ?></span></th>
<?php } ?>
<?php if ($Page->experience->Visible) { // experience ?>
        <th class="<?= $Page->experience->headerCellClass() ?>"><span id="elh_grade_experience" class="grade_experience"><?= $Page->experience->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gpa->Visible) { // gpa ?>
        <th class="<?= $Page->gpa->headerCellClass() ?>"><span id="elh_grade_gpa" class="grade_gpa"><?= $Page->gpa->caption() ?></span></th>
<?php } ?>
<?php if ($Page->scolastic->Visible) { // scolastic ?>
        <th class="<?= $Page->scolastic->headerCellClass() ?>"><span id="elh_grade_scolastic" class="grade_scolastic"><?= $Page->scolastic->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lgd->Visible) { // lgd ?>
        <th class="<?= $Page->lgd->headerCellClass() ?>"><span id="elh_grade_lgd" class="grade_lgd"><?= $Page->lgd->caption() ?></span></th>
<?php } ?>
<?php if ($Page->interview->Visible) { // interview ?>
        <th class="<?= $Page->interview->headerCellClass() ?>"><span id="elh_grade_interview" class="grade_interview"><?= $Page->interview->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th class="<?= $Page->total->headerCellClass() ?>"><span id="elh_grade_total" class="grade_total"><?= $Page->total->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->awardee->Visible) { // awardee ?>
        <td <?= $Page->awardee->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_awardee" class="grade_awardee">
<span<?= $Page->awardee->viewAttributes() ?>>
<?= $Page->awardee->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->international->Visible) { // international ?>
        <td <?= $Page->international->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_international" class="grade_international">
<span<?= $Page->international->viewAttributes() ?>>
<?= $Page->international->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->national->Visible) { // national ?>
        <td <?= $Page->national->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_national" class="grade_national">
<span<?= $Page->national->viewAttributes() ?>>
<?= $Page->national->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->community->Visible) { // community ?>
        <td <?= $Page->community->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_community" class="grade_community">
<span<?= $Page->community->viewAttributes() ?>>
<?= $Page->community->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->experience->Visible) { // experience ?>
        <td <?= $Page->experience->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_experience" class="grade_experience">
<span<?= $Page->experience->viewAttributes() ?>>
<?= $Page->experience->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gpa->Visible) { // gpa ?>
        <td <?= $Page->gpa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_gpa" class="grade_gpa">
<span<?= $Page->gpa->viewAttributes() ?>>
<?= $Page->gpa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->scolastic->Visible) { // scolastic ?>
        <td <?= $Page->scolastic->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_scolastic" class="grade_scolastic">
<span<?= $Page->scolastic->viewAttributes() ?>>
<?= $Page->scolastic->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lgd->Visible) { // lgd ?>
        <td <?= $Page->lgd->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_lgd" class="grade_lgd">
<span<?= $Page->lgd->viewAttributes() ?>>
<?= $Page->lgd->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->interview->Visible) { // interview ?>
        <td <?= $Page->interview->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_interview" class="grade_interview">
<span<?= $Page->interview->viewAttributes() ?>>
<?= $Page->interview->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <td <?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_grade_total" class="grade_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
