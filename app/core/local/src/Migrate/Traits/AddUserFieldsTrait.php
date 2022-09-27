<?php

namespace QSoft\Migrate\Traits;

use CUserFieldEnum;
use CUserTypeEntity;
use Exception;
use RuntimeException;

trait AddUserFieldsTrait
{
    /**
     * @return void
     * @throws Exception
     */
    public function up()
    {
        $this->validateClass();

        global $DB;
        $DB->StartTransaction();

        $dbUserProps = $this->getDbUserProperties();

        foreach ($this->userFields as $property) {
            if (!$this->isPropertyExists($property['FIELD_NAME'], $dbUserProps)) {
                $dbUserProps[] = $property;
                if (!$propertyId = (new CUserTypeEntity)->Add($property)) {
                    $DB->Rollback();
                    throw new RuntimeException("\"$property[FIELD_NAME]\" add error!");
                }

                if ($property['USER_TYPE_ID'] === 'enumeration') {
                    (new CUserFieldEnum)->SetEnumValues($propertyId, $property['VALUES']);
                }
            }
        }

        $DB->Commit();
    }

    /**
     * @return void
     * @throws Exception
     */
    public function down()
    {
        $this->validateClass();

        global $DB;
        $DB->StartTransaction();

        foreach ($this->getDbUserProperties() as $property) {
            if ($this->isPropertyExists($property['FIELD_NAME'], $this->userFields)) {
                if (!(new CUserTypeEntity)->Delete($property['ID'])) {
                    $DB->Rollback();
                    throw new RuntimeException("\"$property[FIELD_NAME]\" delete error!");
                }
            }
        }

        $DB->Commit();
    }

    /**
     * @throws Exception
     */
    private function validateClass(): void
    {
        if (!property_exists($this, 'userFields')) {
            throw new Exception('Can not find $userFields class property');
        }
        if (!property_exists($this, 'entity')) {
            throw new Exception('Can not find $entity class property');
        }
    }

    /**
     * @return array
     */
    private function getDbUserProperties(): array
    {
        $userProperties = [];
        $dbProperties = CUserTypeEntity::GetList([], ['ENTITY_ID' => strtoupper($this->entity)]);
        while ($property = $dbProperties->Fetch()) {
            $userProperties[] = $property;
        }
        return $userProperties;
    }

    /**
     * @param string $fieldName
     * @param array $searchProps
     * @return bool
     */
    private function isPropertyExists(string $fieldName, array $searchProps): bool
    {
        foreach ($searchProps as $prop) {
            if ($prop['FIELD_NAME'] === $fieldName) {
                return true;
            }
        }
        return false;
    }
}