# Block Inventory For Full theme.json Usage

## Core Blocks Required

### Layout and Structure
1. Group
2. Columns
3. Row
4. Spacer
5. Separator

### Content and Media
1. Heading
2. Paragraph
3. Image
4. Gallery
5. List
6. Table
7. Quote
8. Pullquote

### Query and Post Rendering
1. Query Loop
2. Post Template
3. Post Title
4. Post Featured Image
5. Post Excerpt
6. Post Content

### Navigation and Interaction
1. Navigation
2. Search
3. Buttons
4. Button

## Custom Dynamic Blocks Required

### MVP
1. tsp/tour-wizard
2. tsp/mini-wizard
3. tsp/itinerary
4. tsp/dates-prices-table
5. tsp/inquiry-modal
6. tsp/tour-meta-fast-facts

### Phase 2
1. tsp/tour-gallery
2. tsp/tour-reviews
3. tsp/related-tours
4. tsp/tour-search-filter
5. tsp/contact-tabs
6. tsp/currency-switcher
7. tsp/accommodation-gallery

## theme.json Strategy

### Global Tokens
1. Brand palette
2. Typography scale
3. Spacing scale
4. Content and wide layout widths
5. Border, radius, and shadow tokens as needed

### Block Defaults
1. Group spacing and constrained layout defaults
2. Buttons spacing, radius, and type defaults
3. Table readability defaults
4. Query Loop card spacing defaults
5. Navigation spacing defaults

### Style Variations
1. collapse-section
2. booking-button
3. tour-card
4. table-striped
5. filter-button
6. modal-trigger

## Template Mapping Highlights
1. single-tour.php to single-tour.html using core layout blocks plus tsp itinerary, pricing, enquiry, reviews, and related blocks.
2. archive-tour.php to archive-tour.html using Query Loop and tsp mini-wizard.
3. search.php to search.html using tsp search filter wrapper plus Query Loop.
4. template-wizard.php to page-wizard.html using tsp tour-wizard.

## Acceptance Checks
1. All target templates map to block templates with no critical fallback dependency on classic templates.
2. Theme style changes are made through theme.json tokens and styles, not ad hoc template CSS overrides.
3. MVP block set is sufficient for first production cutover.
