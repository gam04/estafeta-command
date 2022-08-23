Changelog
=========

1.0.0
-----

### Added:
- Initial Release

### Changed:
- Initial Release

### Deprecated:
- Initial Release

### Removed:
- Initial Release

### Fixed:
- Initial Release

### Security:
- Initial Release

### BREAKING CHANGES
- Initial Release


1.0.1
-----

### Added:
- New services constants: `CREDIT_NEXT_DAY` & `CREDIT_LAND_PAID`


1.0.2
-----

### Fixed:
- `first()` & `last()` methods could return `null` on `SectionList`


1.0.3
-----

### Fixed:
- Fix `errorData` in `CommandException`.
- Add `firstError` method to obtain the first error message on `CommandException`

1.2.0
-----

### Added:
- Model Validation & Model cleaner. 
  - Some Models has built-in validation rules.
  - Some special characters are removed.
- If a `ValidatedModel` is invalid an `InvalidDataException` is thrown.
- Nullable values indead of empty string values.
- New tests.