<?php

namespace PHPMaker2021\lpdpdss;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for Detail Nilai
 */
class DetailNilai extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $awardee;
    public $international;
    public $national;
    public $community;
    public $experience;
    public $gpa;
    public $scolastic;
    public $lgd;
    public $interview;
    public $total;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'DetailNilai';
        $this->TableName = 'Detail Nilai';
        $this->TableType = 'CUSTOMVIEW';

        // Update Table
        $this->UpdateTable = "grade";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // awardee
        $this->awardee = new DbField('DetailNilai', 'Detail Nilai', 'x_awardee', 'awardee', 'grade.awardee', 'grade.awardee', 20, 20, -1, false, 'grade.awardee', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->awardee->Nullable = false; // NOT NULL field
        $this->awardee->Required = true; // Required field
        $this->awardee->Sortable = true; // Allow sort
        $this->awardee->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->awardee->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->awardee->Lookup = new Lookup('awardee', 'awardee', false, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
        $this->awardee->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->awardee->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->awardee->Param, "CustomMsg");
        $this->Fields['awardee'] = &$this->awardee;

        // international
        $this->international = new DbField('DetailNilai', 'Detail Nilai', 'x_international', 'international', 'grade.international', 'grade.international', 4, 12, -1, false, 'grade.international', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->international->Nullable = false; // NOT NULL field
        $this->international->Required = true; // Required field
        $this->international->Sortable = true; // Allow sort
        $this->international->Lookup = new Lookup('international', 'DetailNilai', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->international->OptionCount = 5;
        $this->international->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->international->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->international->Param, "CustomMsg");
        $this->Fields['international'] = &$this->international;

        // national
        $this->national = new DbField('DetailNilai', 'Detail Nilai', 'x_national', 'national', 'grade.`national`', 'grade.`national`', 4, 12, -1, false, 'grade.`national`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->national->Nullable = false; // NOT NULL field
        $this->national->Required = true; // Required field
        $this->national->Sortable = true; // Allow sort
        $this->national->Lookup = new Lookup('national', 'DetailNilai', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->national->OptionCount = 5;
        $this->national->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->national->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->national->Param, "CustomMsg");
        $this->Fields['national'] = &$this->national;

        // community
        $this->community = new DbField('DetailNilai', 'Detail Nilai', 'x_community', 'community', 'grade.community', 'grade.community', 4, 12, -1, false, 'grade.community', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->community->Nullable = false; // NOT NULL field
        $this->community->Required = true; // Required field
        $this->community->Sortable = true; // Allow sort
        $this->community->Lookup = new Lookup('community', 'DetailNilai', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->community->OptionCount = 5;
        $this->community->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->community->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->community->Param, "CustomMsg");
        $this->Fields['community'] = &$this->community;

        // experience
        $this->experience = new DbField('DetailNilai', 'Detail Nilai', 'x_experience', 'experience', 'grade.experience', 'grade.experience', 4, 12, -1, false, 'grade.experience', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->experience->Nullable = false; // NOT NULL field
        $this->experience->Required = true; // Required field
        $this->experience->Sortable = true; // Allow sort
        $this->experience->Lookup = new Lookup('experience', 'DetailNilai', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->experience->OptionCount = 5;
        $this->experience->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->experience->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->experience->Param, "CustomMsg");
        $this->Fields['experience'] = &$this->experience;

        // gpa
        $this->gpa = new DbField('DetailNilai', 'Detail Nilai', 'x_gpa', 'gpa', 'grade.gpa', 'grade.gpa', 4, 12, -1, false, 'grade.gpa', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->gpa->Nullable = false; // NOT NULL field
        $this->gpa->Required = true; // Required field
        $this->gpa->Sortable = true; // Allow sort
        $this->gpa->Lookup = new Lookup('gpa', 'DetailNilai', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->gpa->OptionCount = 4;
        $this->gpa->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->gpa->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->gpa->Param, "CustomMsg");
        $this->Fields['gpa'] = &$this->gpa;

        // scolastic
        $this->scolastic = new DbField('DetailNilai', 'Detail Nilai', 'x_scolastic', 'scolastic', 'grade.scolastic', 'grade.scolastic', 4, 12, -1, false, 'grade.scolastic', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->scolastic->Nullable = false; // NOT NULL field
        $this->scolastic->Required = true; // Required field
        $this->scolastic->Sortable = true; // Allow sort
        $this->scolastic->Lookup = new Lookup('scolastic', 'DetailNilai', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->scolastic->OptionCount = 5;
        $this->scolastic->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->scolastic->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->scolastic->Param, "CustomMsg");
        $this->Fields['scolastic'] = &$this->scolastic;

        // lgd
        $this->lgd = new DbField('DetailNilai', 'Detail Nilai', 'x_lgd', 'lgd', 'grade.lgd', 'grade.lgd', 4, 12, -1, false, 'grade.lgd', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->lgd->Sortable = true; // Allow sort
        $this->lgd->Lookup = new Lookup('lgd', 'DetailNilai', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->lgd->OptionCount = 6;
        $this->lgd->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->lgd->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->lgd->Param, "CustomMsg");
        $this->Fields['lgd'] = &$this->lgd;

        // interview
        $this->interview = new DbField('DetailNilai', 'Detail Nilai', 'x_interview', 'interview', 'grade.interview', 'grade.interview', 4, 12, -1, false, 'grade.interview', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->interview->Sortable = true; // Allow sort
        $this->interview->Lookup = new Lookup('interview', 'DetailNilai', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->interview->OptionCount = 6;
        $this->interview->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->interview->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->interview->Param, "CustomMsg");
        $this->Fields['interview'] = &$this->interview;

        // total
        $this->total = new DbField('DetailNilai', 'Detail Nilai', 'x_total', 'total', 'grade.total', 'grade.total', 4, 12, -1, false, 'grade.total', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->total->Sortable = true; // Allow sort
        $this->total->DefaultDecimalPrecision = 5; // Default decimal precision
        $this->total->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->total->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->total->Param, "CustomMsg");
        $this->Fields['total'] = &$this->total;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "grade";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("grade.awardee, grade.international, grade.`national`, grade.community, grade.experience, grade.gpa, grade.scolastic, grade.lgd, grade.interview, grade.total");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->awardee->DbValue = $row['awardee'];
        $this->international->DbValue = $row['international'];
        $this->national->DbValue = $row['national'];
        $this->community->DbValue = $row['community'];
        $this->experience->DbValue = $row['experience'];
        $this->gpa->DbValue = $row['gpa'];
        $this->scolastic->DbValue = $row['scolastic'];
        $this->lgd->DbValue = $row['lgd'];
        $this->interview->DbValue = $row['interview'];
        $this->total->DbValue = $row['total'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("detailnilailist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "detailnilaiview") {
            return $Language->phrase("View");
        } elseif ($pageName == "detailnilaiedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "detailnilaiadd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "DetailNilaiView";
            case Config("API_ADD_ACTION"):
                return "DetailNilaiAdd";
            case Config("API_EDIT_ACTION"):
                return "DetailNilaiEdit";
            case Config("API_DELETE_ACTION"):
                return "DetailNilaiDelete";
            case Config("API_LIST_ACTION"):
                return "DetailNilaiList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "detailnilailist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("detailnilaiview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("detailnilaiview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "detailnilaiadd?" . $this->getUrlParm($parm);
        } else {
            $url = "detailnilaiadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("detailnilaiedit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("detailnilaiadd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("detailnilaidelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->awardee->setDbValue($row['awardee']);
        $this->international->setDbValue($row['international']);
        $this->national->setDbValue($row['national']);
        $this->community->setDbValue($row['community']);
        $this->experience->setDbValue($row['experience']);
        $this->gpa->setDbValue($row['gpa']);
        $this->scolastic->setDbValue($row['scolastic']);
        $this->lgd->setDbValue($row['lgd']);
        $this->interview->setDbValue($row['interview']);
        $this->total->setDbValue($row['total']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // awardee

        // international

        // national

        // community

        // experience

        // gpa

        // scolastic

        // lgd

        // interview

        // total

        // awardee
        $curVal = trim(strval($this->awardee->CurrentValue));
        if ($curVal != "") {
            $this->awardee->ViewValue = $this->awardee->lookupCacheOption($curVal);
            if ($this->awardee->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->awardee->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->awardee->Lookup->renderViewRow($rswrk[0]);
                    $this->awardee->ViewValue = $this->awardee->displayValue($arwrk);
                } else {
                    $this->awardee->ViewValue = $this->awardee->CurrentValue;
                }
            }
        } else {
            $this->awardee->ViewValue = null;
        }
        $this->awardee->ViewCustomAttributes = "";

        // international
        if (strval($this->international->CurrentValue) != "") {
            $this->international->ViewValue = $this->international->optionCaption($this->international->CurrentValue);
        } else {
            $this->international->ViewValue = null;
        }
        $this->international->ViewCustomAttributes = "";

        // national
        if (strval($this->national->CurrentValue) != "") {
            $this->national->ViewValue = $this->national->optionCaption($this->national->CurrentValue);
        } else {
            $this->national->ViewValue = null;
        }
        $this->national->ViewCustomAttributes = "";

        // community
        if (strval($this->community->CurrentValue) != "") {
            $this->community->ViewValue = $this->community->optionCaption($this->community->CurrentValue);
        } else {
            $this->community->ViewValue = null;
        }
        $this->community->ViewCustomAttributes = "";

        // experience
        if (strval($this->experience->CurrentValue) != "") {
            $this->experience->ViewValue = $this->experience->optionCaption($this->experience->CurrentValue);
        } else {
            $this->experience->ViewValue = null;
        }
        $this->experience->ViewCustomAttributes = "";

        // gpa
        if (strval($this->gpa->CurrentValue) != "") {
            $this->gpa->ViewValue = $this->gpa->optionCaption($this->gpa->CurrentValue);
        } else {
            $this->gpa->ViewValue = null;
        }
        $this->gpa->ViewCustomAttributes = "";

        // scolastic
        if (strval($this->scolastic->CurrentValue) != "") {
            $this->scolastic->ViewValue = $this->scolastic->optionCaption($this->scolastic->CurrentValue);
        } else {
            $this->scolastic->ViewValue = null;
        }
        $this->scolastic->ViewCustomAttributes = "";

        // lgd
        if (strval($this->lgd->CurrentValue) != "") {
            $this->lgd->ViewValue = $this->lgd->optionCaption($this->lgd->CurrentValue);
        } else {
            $this->lgd->ViewValue = null;
        }
        $this->lgd->ViewCustomAttributes = "";

        // interview
        if (strval($this->interview->CurrentValue) != "") {
            $this->interview->ViewValue = $this->interview->optionCaption($this->interview->CurrentValue);
        } else {
            $this->interview->ViewValue = null;
        }
        $this->interview->ViewCustomAttributes = "";

        // total
        $this->total->ViewValue = $this->total->CurrentValue;
        $this->total->ViewValue = FormatNumber($this->total->ViewValue, 5, -2, -2, -2);
        $this->total->ViewCustomAttributes = "";

        // awardee
        $this->awardee->LinkCustomAttributes = "";
        $this->awardee->HrefValue = "";
        $this->awardee->TooltipValue = "";

        // international
        $this->international->LinkCustomAttributes = "";
        $this->international->HrefValue = "";
        $this->international->TooltipValue = "";

        // national
        $this->national->LinkCustomAttributes = "";
        $this->national->HrefValue = "";
        $this->national->TooltipValue = "";

        // community
        $this->community->LinkCustomAttributes = "";
        $this->community->HrefValue = "";
        $this->community->TooltipValue = "";

        // experience
        $this->experience->LinkCustomAttributes = "";
        $this->experience->HrefValue = "";
        $this->experience->TooltipValue = "";

        // gpa
        $this->gpa->LinkCustomAttributes = "";
        $this->gpa->HrefValue = "";
        $this->gpa->TooltipValue = "";

        // scolastic
        $this->scolastic->LinkCustomAttributes = "";
        $this->scolastic->HrefValue = "";
        $this->scolastic->TooltipValue = "";

        // lgd
        $this->lgd->LinkCustomAttributes = "";
        $this->lgd->HrefValue = "";
        $this->lgd->TooltipValue = "";

        // interview
        $this->interview->LinkCustomAttributes = "";
        $this->interview->HrefValue = "";
        $this->interview->TooltipValue = "";

        // total
        $this->total->LinkCustomAttributes = "";
        $this->total->HrefValue = "";
        $this->total->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // awardee
        $this->awardee->EditAttrs["class"] = "form-control";
        $this->awardee->EditCustomAttributes = "";
        $this->awardee->PlaceHolder = RemoveHtml($this->awardee->caption());

        // international
        $this->international->EditCustomAttributes = "";
        $this->international->EditValue = $this->international->options(false);
        $this->international->PlaceHolder = RemoveHtml($this->international->caption());

        // national
        $this->national->EditCustomAttributes = "";
        $this->national->EditValue = $this->national->options(false);
        $this->national->PlaceHolder = RemoveHtml($this->national->caption());

        // community
        $this->community->EditCustomAttributes = "";
        $this->community->EditValue = $this->community->options(false);
        $this->community->PlaceHolder = RemoveHtml($this->community->caption());

        // experience
        $this->experience->EditCustomAttributes = "";
        $this->experience->EditValue = $this->experience->options(false);
        $this->experience->PlaceHolder = RemoveHtml($this->experience->caption());

        // gpa
        $this->gpa->EditCustomAttributes = "";
        $this->gpa->EditValue = $this->gpa->options(false);
        $this->gpa->PlaceHolder = RemoveHtml($this->gpa->caption());

        // scolastic
        $this->scolastic->EditCustomAttributes = "";
        $this->scolastic->EditValue = $this->scolastic->options(false);
        $this->scolastic->PlaceHolder = RemoveHtml($this->scolastic->caption());

        // lgd
        $this->lgd->EditCustomAttributes = "";
        $this->lgd->EditValue = $this->lgd->options(false);
        $this->lgd->PlaceHolder = RemoveHtml($this->lgd->caption());

        // interview
        $this->interview->EditCustomAttributes = "";
        $this->interview->EditValue = $this->interview->options(false);
        $this->interview->PlaceHolder = RemoveHtml($this->interview->caption());

        // total
        $this->total->EditAttrs["class"] = "form-control";
        $this->total->EditCustomAttributes = "";
        $this->total->EditValue = $this->total->CurrentValue;
        $this->total->PlaceHolder = RemoveHtml($this->total->caption());
        if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue)) {
            $this->total->EditValue = FormatNumber($this->total->EditValue, -2, -2, -2, -2);
        }

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->awardee);
                    $doc->exportCaption($this->international);
                    $doc->exportCaption($this->national);
                    $doc->exportCaption($this->community);
                    $doc->exportCaption($this->experience);
                    $doc->exportCaption($this->gpa);
                    $doc->exportCaption($this->scolastic);
                    $doc->exportCaption($this->lgd);
                    $doc->exportCaption($this->interview);
                    $doc->exportCaption($this->total);
                } else {
                    $doc->exportCaption($this->awardee);
                    $doc->exportCaption($this->international);
                    $doc->exportCaption($this->national);
                    $doc->exportCaption($this->community);
                    $doc->exportCaption($this->experience);
                    $doc->exportCaption($this->gpa);
                    $doc->exportCaption($this->scolastic);
                    $doc->exportCaption($this->lgd);
                    $doc->exportCaption($this->interview);
                    $doc->exportCaption($this->total);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->awardee);
                        $doc->exportField($this->international);
                        $doc->exportField($this->national);
                        $doc->exportField($this->community);
                        $doc->exportField($this->experience);
                        $doc->exportField($this->gpa);
                        $doc->exportField($this->scolastic);
                        $doc->exportField($this->lgd);
                        $doc->exportField($this->interview);
                        $doc->exportField($this->total);
                    } else {
                        $doc->exportField($this->awardee);
                        $doc->exportField($this->international);
                        $doc->exportField($this->national);
                        $doc->exportField($this->community);
                        $doc->exportField($this->experience);
                        $doc->exportField($this->gpa);
                        $doc->exportField($this->scolastic);
                        $doc->exportField($this->lgd);
                        $doc->exportField($this->interview);
                        $doc->exportField($this->total);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
