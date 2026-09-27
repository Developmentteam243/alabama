# Alabama Portal — Client Verification & Testing Guide

This document summarizes all updates implemented in accordance with **`Alabama Changes (1).docx`** and provides exact step-by-step instructions for testing and verifying each feature.

---

## 1. Homepage Hero Banner Slider & Mobile Reordering
### Summary of Changes:
- Replaced the single static hero image with a **dynamic category slider**.
- Added dynamic call-to-action buttons (`Explore [Category Name] →`) linking directly to each respective category.
- Fixed mobile responsive ordering so the banner media displays first on mobile screens with the text below, eliminating text-over-image overlap.
- Removed the static "Dubai Investments Park 2" tag box.

### How to Verify:
1. Open the Homepage: [http://127.0.0.1:8000/](http://127.0.0.1:8000/)
2. **Desktop check**:
   - Verify the category slides automatically or by using the arrow / bullet controls.
   - Click the red **"Explore [Category Name] →"** button on any slide and verify it takes you to that category's page.
3. **Mobile check**:
   - Switch browser to Mobile View (press `F12` > toggle Device Toolbar, or view on a phone).
   - Verify the slide image appears on top and the hero text/buttons appear neatly underneath.

---

## 2. Categories Horizontal Carousel Slider
### Summary of Changes:
- Replaced the static 3-column category grid with a **touch/swipe-friendly horizontal slider**.

### How to Verify:
1. On the Homepage, scroll down to the **"From boiler room to bathroom. One supplier."** section.
2. Use the arrow buttons on the top right (or drag/swipe horizontally) to browse through the categories.
3. Click any category card to verify it navigates to the category page.

---

## 3. "Featured Products" Toggle & Homepage Carousel
### Summary of Changes:
- Added a `is_featured` toggle switch in the Admin Product Manager.
- Updated the homepage collections section to display a dedicated **Featured Products Carousel**.

### How to Verify:
1. **Admin Panel**:
   - Go to [http://127.0.0.1:8000/products](http://127.0.0.1:8000/products) (Admin login required).
   - Edit any product (or create a new one).
   - Turn the **"⭐ Featured Product"** switch **ON** or **OFF** and save.
   - Notice the green **"Featured"** badge in the admin table.
2. **Frontend**:
   - Go to the Homepage: [http://127.0.0.1:8000/](http://127.0.0.1:8000/)
   - Scroll down to the **"Featured Collections"** slider.
   - Verify the products you marked as featured appear in this slider.

---

## 4. Reduced Whitespace / Section Spacing
### Summary of Changes:
- Reduced vertical section padding from `104px` to `56px` across all sections on every page to remove excessive gaps.

### How to Verify:
1. Browse through the Homepage, About Us, Brand Spotlight, and Category pages.
2. Verify that spacing between sections is compact, well-proportioned, and readable.

---

## 5. Blog Detail Sidebar CTA Card
### Summary of Changes:
- Replaced the sidebar's gray "Looking for Project Supply?" card styling with a **solid black background (`#000000`)** and a **vibrant red button (`#e11d48`)**.

### How to Verify:
1. Open any blog post, for example: [http://127.0.0.1:8000/blog](http://127.0.0.1:8000/blog) > Click on a blog post.
2. Check the right sidebar:
   - Verify the **"Looking for Project Supply?"** card has a rich solid black background.
   - Verify the **"Get In Touch"** button is vibrant red and hoverable.

---

## 6. Social Share & Footer Icons Border Fix
### Summary of Changes:
- Removed circular border distortion and oval stretching on footer social links and blog share buttons.

### How to Verify:
1. Scroll down to the Footer on any page.
2. Verify the Facebook, LinkedIn, Instagram, and WhatsApp icons are clean, centered squares with crisp hover transitions.
3. Check the social share bar in any blog post detail page to ensure clean icon rendering.

---

## 7. Blog Admin WYSIWYG Rich-Text Editor (CKEditor)
### Summary of Changes:
- Added a rich text editor to both the **Excerpt / Short Description** and **Article Content** fields in the blog admin.
- Includes support for **Hyperlinks (🔗)**, **Headings (H1-H4)**, **Bold / Italic / Underline**, **Color Highlights**, and **Tables**.

### How to Verify:
1. Navigate to Admin Blog Create: [http://127.0.0.1:8000/blogs/create](http://127.0.0.1:8000/blogs/create) (or Edit an existing blog).
2. Look at **"Excerpt / Short Description"** and **"Content"**:
   - Highlight text and click the **Link icon (🔗)** to create an internal/external hyperlink with custom target window options.
   - Use the **Format dropdown** to apply H1, H2, H3 headings.
   - Apply bold, underline, bullet lists, or tables.
3. Save the post and view the live blog post on the frontend to verify the formatted content and working hyperlinks.

---

## 8. Dedicated Products Catalog & Multi-Filter System
### Summary of Changes:
- Created a dedicated public catalogue at [http://127.0.0.1:8000/catalogue](http://127.0.0.1:8000/catalogue).
- Equipped with multi-facet filters: Search keyword, Category, Subcategory, Brand, Capacity (L), Orientation/Mounting, Featured-only checkbox, and Sorting.
- Linked all **"Products"** buttons in the navbar and footer directly to this catalog.

### How to Verify:
1. Click **"Products"** in the top navigation bar or footer.
2. Test the filters:
   - Enter a search keyword (e.g. `Alpha`, `Electric`, `Vertical`).
   - Select a Brand (e.g. `Ariston`, `Milano`, `Alabama`).
   - Filter by Category or Subcategory.
   - Toggle **"Featured Only"** checkbox and click **Apply Filters**.
3. Verify that pagination maintains your filter selections across pages.

---

## 9. Category & Subcategory Pages
### Summary of Changes:
- Added a **Subcategory filter dropdown** in the category page filter bar.
- Added featured category product display and smooth pagination.

### How to Verify:
1. Go to any category page (e.g. [http://127.0.0.1:8000/category/hot-water-system](http://127.0.0.1:8000/category/hot-water-system)).
2. Under **"Popular products"**, test the **Subcategory dropdown** filter.
3. Select a subcategory and click **Search** to confirm products are filtered dynamically.
