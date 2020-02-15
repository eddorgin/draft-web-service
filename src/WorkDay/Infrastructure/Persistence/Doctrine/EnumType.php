<?php


namespace App\WorkDay\Infrastructure\Persistence\Doctrine;

use App\WorkDay\Domain\Model\WorkDayStatus;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Class EnumType
 * @package App\WorkDay\Infrastructure\Persistence\Doctrine
 */
abstract class EnumType extends Type
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $values = array();

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $values = array_map(function($val) { return "'".$val."'"; }, $this->values);

        return "ENUM(".implode(", ", $values).")";
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    /**
     * @param WorkDayStatus $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value && !in_array($value->toString(), $this->values)) {
            throw new \InvalidArgumentException("Invalid '". var_dump($value) ."' value.");
        }
        return $value->toString();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param AbstractPlatform $platform
     * @return bool
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}