# GitHub Copilot Instructions - The Safari Partners Child Theme

## Project Overview
This is a WordPress child theme for The Safari Partners website, built on the LSX theme framework. The project focuses on tour operator functionality with a current major rebuild of single tour pages and responsive design improvements.

## Current Development Focus
- **Trip Finder** - Remove all references to the trip finder, and its functionality
- **Single Tour Rebuild (v2.0)**: Complete overhaul of single tour page templates and functionality
- **Responsive Design**: Mobile-first responsive coding across all components
- **Tour Operator Integration**: Custom tour management and booking system

## Technology Stack
- **WordPress**: Child theme based on LSX framework
- **PHP**: WordPress standards compliant
- **CSS/SCSS**: Custom responsive stylesheets
- **JavaScript**: Custom tour functionality and interactions
- **Build Tools**: Gulp for CSS/JS compilation
- **Tour System**: LSX Tour Operator integration with WETU API

## Code Standards & Conventions

### WordPress Standards
- Follow WordPress Coding Standards for PHP
- Use WordPress hooks and filters appropriately
- Implement proper sanitization and validation
- Use WordPress templating hierarchy

### CSS/SCSS Guidelines
- Mobile-first responsive approach
- Use semantic class naming
- Maintain existing custom.css structure
- Target breakpoints: 767px, 900px, 1200px
- Avoid `!important` unless absolutely necessary

### PHP Class Structure
- Namespace: `tsp_child\classes`
- Follow existing class naming conventions (e.g., `class-feature-name.php`)
- Use singleton pattern where appropriate (see `class-core.php`)

## Project Structure

### Key Directories
- `/classes/` - PHP class files for core functionality
- `/assets/css/` - Stylesheets and SCSS files
- `/assets/js/` - JavaScript files
- `/partials/` - Template partials and components
- `/page-templates/` - Custom page templates

### Important Files
- `single-tour.php` - Main single tour template (being rebuilt)
- `functions.php` - Theme functionality
- `assets/css/custom.css` - Main stylesheet
- `classes/class-core.php` - Core theme functionality

## Tour-Related Development

### Custom Post Types
- `tour` - Main tour content
- `destination` - Tour destinations
- `review` - Tour reviews
- `travel-style` - Tour categories/styles

### Tour Page Components
When working on single tour pages, include these elements:
- Tour overview and description
- Day-by-day itinerary
- Accommodation details with galleries
- Pricing and dates
- Maps and location information
- Booking/inquiry forms
- Related tours
- Reviews and testimonials

### Responsive Tour Features
- Mobile navigation for tour sections
- Touch-friendly image galleries
- Collapsible itinerary sections
- Mobile-optimized booking forms
- Responsive maps and media

## Common Patterns

### Template Structure
```php
// Single tour template pattern
get_header();
while ( have_posts() ) : the_post();
    // Tour content sections
    get_template_part( 'partials/tour-wizard-overview' );
    get_template_part( 'partials/tour-wizard-day' );
    get_template_part( 'partials/tour-wizard-accommodation' );
    // etc.
endwhile;
get_footer();
```

### CSS Responsive Patterns
```css
/* Mobile-first approach */
.tour-element {
    /* Mobile styles */
}

@media (min-width: 768px) {
    .tour-element {
        /* Tablet styles */
    }
}

@media (min-width: 1200px) {
    .tour-element {
        /* Desktop styles */
    }
}
```

### JavaScript Patterns
- Use jQuery (already loaded by WordPress)
- Implement touch/swipe for mobile galleries
- Progressive enhancement approach

## Development Guidelines

### Single Tour Page Development
- Prioritize mobile experience first
- Ensure all tour information is easily accessible
- Implement smooth transitions between sections
- Optimize images and media for performance
- Test across multiple devices and browsers

### Responsive Design Priorities
1. Mobile navigation and usability
2. Touch-friendly interactive elements
3. Readable typography at all screen sizes
4. Optimized images and media queries
5. Fast loading performance

### WETU Integration
- Handle WETU API responses appropriately
- Implement proper error handling
- Cache API responses when possible
- Follow existing WETU class patterns in `/classes/`

## Testing Considerations
- Test on actual mobile devices
- Verify touch interactions work properly
- Check performance with large image galleries
- Validate booking forms on all screen sizes
- Test tour navigation on mobile

## Performance Guidelines
- Optimize images for responsive delivery
- Minimize CSS/JS file sizes
- Use appropriate caching strategies
- Lazy load images where possible
- Minimize database queries

## When Suggesting Code
- Always consider mobile-first responsive design
- Provide both PHP and corresponding CSS when relevant
- Include proper WordPress escaping and sanitization
- Follow existing theme patterns and structure
- Consider tour-specific functionality and user experience
- Test suggestions against common responsive breakpoints
