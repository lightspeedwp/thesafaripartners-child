# Custom Fields And Plugin Boundary

## Principle
Theme owns presentation only. Plugin owns business logic, integrations, indexing, import and sync, taxonomy registration, endpoints, shortcodes, and admin write flows.

## Preserve These Meta And Field Contracts

### Tour Pricing and Schedule
1. price_row
2. price_row_*_column_*
3. column_titles_column_*
4. prices_footnote
5. tour_schedule_upload
6. append_dates_and_prices

### Relationships
1. destination_to_tour
2. accommodation_to_tour
3. review_to_tour
4. related_tours

### WETU Sync Keys
1. lsx_wetu_id
2. lsx_wetu_modified_date
3. lsx_wetu_sync_action_id
4. lsx_wetu_sync_date

### Review Keys
1. reviewer_name
2. date_of_visit_start

### ACF Fields Used in Presentation
1. download_itinerary
2. wizard_image
3. banner
4. tagline
5. page_image
6. subheading
7. page-image

## Plugin-Owned Modules (Move Out Of Theme)
1. WETU importer and automation from classes/class-wetu-importer.php and classes/class-wetu-automation.php.
2. WETU REST endpoint from classes/class-wetu-endpoints.php.
3. Dates and prices importer from classes/class-dates-prices-admin.php.
4. Currency logic from classes/class-multi-currency.php.
5. FacetWP and SearchWP indexing customisations from classes/class-post-connections.php.
6. Taxonomy and setup logic from classes/class-setup.php.
7. Form and search integrations from classes/class-frontend.php.

## Theme-Owned Areas
1. Block templates.
2. Template parts.
3. Patterns.
4. theme.json settings and styles.
5. Presentational CSS and light presentational JS.

## Known Blockers And Mitigations
1. LSX dependency: keep wrapper APIs in plugin blocks and do not fork LSX behaviour.
2. FacetWP shortcode coupling: use tsp/tour-search-filter wrapper block with JS event handling on updates.
3. Gravity Forms modal flow: keep modal trigger and prefilled values in plugin block render path.
4. WETU scheduled sync dependency: preserve Action Scheduler and key meta writes.
5. Legacy admin and field ID assumptions: harden with nonce checks, capability checks, and sanitisation.

## Acceptance Checks
1. All fields listed above are readable and render correctly after cutover.
2. No plugin-owned logic remains bootstrapped from theme entry points.
3. Search, filtering, and enquiry flows remain intact.
4. Staging parity checks pass for single tour, archive, and search paths.
