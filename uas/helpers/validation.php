<?php
function validateRequired($field, $label) {
    if (empty(trim($field))) {
        return "$label wajib diisi";
    }
    return null;
}

function validateMinLength($field, $label, $min) {
    if (strlen(trim($field)) < $min) {
        return "$label minimal $min karakter";
    }
    return null;
}

function validateMaxLength($field, $label, $max) {
    if (strlen(trim($field)) > $max) {
        return "$label maksimal $max karakter";
    }
    return null;
}

function validateNumeric($field, $label) {
    if (!is_numeric($field) || $field < 0) {
        return "$label harus angka positif";
    }
    return null;
}

function validateDate($date, $label) {
    if (!strtotime($date)) {
        return "$label tidak valid";
    }
    return null;
}

function validateDateRange($start, $end) {
    if (strtotime($start) > strtotime($end)) {
        return 'Tanggal selesai harus setelah tanggal mulai';
    }
    return null;
}

function validateUnique($conn, $table, $field, $value, $exclude_id = null) {
    $value = mysqli_real_escape_string($conn, $value);
    $query = "SELECT id FROM $table WHERE $field = '$value'";
    if ($exclude_id) {
        $query .= " AND id != " . intval($exclude_id);
    }
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}

function validate($conn, $rules, $data) {
    $errors = [];

    foreach ($rules as $field => $fieldRules) {
        $label = $fieldRules['label'] ?? $field;
        $value = $data[$field] ?? '';

        if (isset($fieldRules['required']) && $fieldRules['required']) {
            $error = validateRequired($value, $label);
            if ($error) {
                $errors[$field] = $error;
                continue;
            }
        }

        if (isset($fieldRules['min']) && $value) {
            $error = validateMinLength($value, $label, $fieldRules['min']);
            if ($error) {
                $errors[$field] = $error;
                continue;
            }
        }

        if (isset($fieldRules['max']) && $value) {
            $error = validateMaxLength($value, $label, $fieldRules['max']);
            if ($error) {
                $errors[$field] = $error;
                continue;
            }
        }

        if (isset($fieldRules['numeric']) && $fieldRules['numeric'] && $value !== '') {
            $error = validateNumeric($value, $label);
            if ($error) {
                $errors[$field] = $error;
                continue;
            }
        }

        if (isset($fieldRules['date']) && $fieldRules['date'] && $value) {
            $error = validateDate($value, $label);
            if ($error) {
                $errors[$field] = $error;
                continue;
            }
        }

        if (isset($fieldRules['unique']) && $fieldRules['unique'] && $value) {
            $table = $fieldRules['unique_table'];
            $exclude = $fieldRules['unique_exclude'] ?? null;
            if (validateUnique($conn, $table, $field, $value, $exclude)) {
                $errors[$field] = "$label sudah ada";
                continue;
            }
        }
    }

    return $errors;
}
