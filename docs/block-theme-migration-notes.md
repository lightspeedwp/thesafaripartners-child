# Block Theme Migration Notes

## Goal
Migrate the theme to a block theme while keeping business logic out of the theme and fully using theme.json for design tokens, block defaults, and style variations.

## Scope Included
1. Template conversion map for tour, destination, review, taxonomy, search, and wizard flows.
2. Block inventory for core blocks and custom dynamic blocks.
3. Plugin boundary for integrations and data logic.
4. Custom field and meta contracts that must be preserved.

## Scope Excluded
1. Direct code implementation.
2. Removing dependency plugins (LSX Tour Operator, FacetWP, SearchWP, Gravity Forms, WETU).

## Target Block Templates
1. index.html
2. home.html
3. page.html
4. single.html
5. single-tour.html
6. single-destination.html
7. single-review.html
8. archive.html
9. archive-tour.html
10. archive-destination.html
11. archive-review.html
12. taxonomy.html
13. taxonomy-who.html
14. taxonomy-travel-style.html
15. search.html
16. 404.html

## Target Template Parts
1. header.html
2. footer.html
3. tour-overview.html
4. tour-itinerary.html
5. tour-pricing.html
6. tour-maps.html
7. tour-accommodation.html
8. tour-cta-buttons.html
9. search-results-header.html
10. search-filters-panel.html

## Acceptance Checks
1. Tour single pages render with itinerary, prices, reviews, related tours, and CTA behaviour.
2. Tour and destination archives render with filtering and expected ordering.
3. Search page filtering and result updates match current behaviour.
4. Taxonomy pages for who and travel style render key headings, images, and content.
5. No critical regressions in booking and enquiry flow.
