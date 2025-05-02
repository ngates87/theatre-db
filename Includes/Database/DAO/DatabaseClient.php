<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/Includes/Objects/ApplicationHelper.php");
abstract class DatabaseClient
{

    private static $m_sDSN = "mysql:host=127.0.0.1;dbname=masc";
    private static $m_sUser = "masc";
    private static $m_sDBPassword = "exitstageleft";
    public $m_PDOTheatre = null;
    protected static $PDOConnection = null;

    public function __construct()
    {

        $this->m_PDOTheatre = self::GetConnection();
    }

    public static function GetConnection()
    {
        if (is_null(self::$PDOConnection))
        {
            try
            {
                self::$PDOConnection = new PDO(self::$m_sDSN, self::$m_sUser, self::$m_sDBPassword);
				//self::$PDOConnection = new PDO(self::$m_sDSN);
            }
            catch (PDOException $e)
            {
                die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
            }
        }

        return self::$PDOConnection;
    }

    public function __destruct()
    {
        $this->m_PDOTheatre = null;
    }

    public function NewTransactionScope()
    {
        $this->m_PDOTheatre->beginTransaction();
    }

    public function CommitTransaction()
    {
        $this->m_PDOTheatre->commit();
    }

    public function Rollback()
    {
        try
        {
            $this->m_PDOTheatre->rollBack();
        }
        catch (exception $e)
        {

        }
    }

    protected function InsertNewRecord($SqlStatement, $aoParams)
    {
        $sqlStatement = $this->m_PDOTheatre->prepare($SqlStatement);
        $sqlStatement->execute($aoParams);
        //var_dump($sqlStatement->errorInfo());
        $lastID = -1;
        if ($sqlStatement->rowCount() == 1)
        {
            $lastID = $this->m_PDOTheatre->lastInsertId();

        }
        if($lastID == -1 && ApplicationHelper::IsDevelopmentServer())
        {
            var_dump($sqlStatement->errorInfo());
            var_dump($aoParams);
        }
        //var_dump($lastID);
        return $lastID;
    }

    protected function UpdateRecord($sSqlStatement, $aoParams)
    {
        /* @var $sqlStatement PDOStatement */

        $sqlStatement = $this->ParameterizedQuery($sSqlStatement);
        /* @var $bReturn boolean */

        $bReturn = (bool) $sqlStatement->execute($aoParams);
        //echo $sqlStatement->errorInfo();
        //$sqlStatement->


        if($bReturn == false)
        {
            throw new Exception($sqlStatement->errorInfo());
            if(ApplicationHelper::IsDevelopmentServer())
            {
                var_dump($sqlStatement->errorInfo());
                var_dump($aoParams);
            }
        }
        return $bReturn;
    }

    protected function UpdateRecordExpected($sSqlStatement, $aoParams, $nRowsAffected)
    {
        //$this->NewTransactionScope();
        /* @var $sqlStatement PDOStatement */
        $sqlStatement = $this->ParameterizedQuery($sSqlStatement);
        /* @var $bReturn boolean */

        if($sqlStatement->execute($aoParams) == TRUE)
        {
            if ($sqlStatement->rowCount() == $nRowsAffected)
            {
                //$this->CommitTransaction();

                return TRUE;
            }
        }
        echo $sqlStatement->errorInfo();
        //$this->Rollback();
        return FALSE;

    }

    public function GetTheatreDAO()
    {
        return $this->m_PDOTheatre;
    }

    public function ParameterizedQuery($sSql)
    {
        return $this->m_PDOTheatre->prepare($sSql);
    }


}
