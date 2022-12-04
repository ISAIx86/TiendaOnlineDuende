DELIMITER $$
CREATE FUNCTION uuid_to_bin (_varchar_uuid VARCHAR(36)) RETURNS BINARY(16)
DETERMINISTIC
BEGIN
	declare _bin_uuid binary(16);
    set _bin_uuid = unhex(replace(_varchar_uuid, "-", ""));
    return _bin_uuid;
END
$$ DELIMITER ;

DELIMITER $$
CREATE FUNCTION bin_to_uuid (_binary_uuid BINARY(16)) RETURNS VARCHAR(36)
DETERMINISTIC
BEGIN
	declare _varchar_uuid varchar(36);
    set _varchar_uuid =
    	LOWER(CONCAT(LEFT(HEX(_binary_uuid), 8), '-', MID(HEX(_binary_uuid), 9, 4), '-',MID(HEX(_binary_uuid), 13, 4), '-',MID(HEX(_binary_uuid), 17, 4), '-',RIGHT(HEX(_binary_uuid), 12)));
    return _varchar_uuid;
END;
$$ DELIMITER ;