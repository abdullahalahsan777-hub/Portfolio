# Skill: jQuery, DataTables & SortableJS Reordering

## Context & Overview
The Admin Control Panel utilizes **jQuery 3.7.1**, **DataTables**, **SortableJS**, and **Toastr** for high-density administrative operations, tabular views, and real-time drag-and-drop sort reordering.

---

## 1. SortableJS Drag-and-Drop Reordering Engine
- All 9 Website Modules (Services, Projects, Galleries, Skills, Resume, Pricing, Testimonials, Blog, FAQs) feature SortableJS drag-and-drop reordering.
- **HTML Pattern**:
  ```html
  <tbody id="sortableList" data-reorder-url="{{ route('admin.services.reorder') }}">
      @foreach($services as $service)
          <tr data-id="{{ $service->id }}" class="cursor-move">
              <td><span class="sort-order-badge">#{{ $service->sort_order }}</span></td>
              ...
          </tr>
      @endforeach
  </tbody>
  ```
- **JavaScript Initialization**:
  ```javascript
  const el = document.getElementById('sortableList');
  if (el) {
      new Sortable(el, {
          animation: 150,
          handle: '.cursor-move',
          onEnd: function() {
              const order = [];
              el.querySelectorAll('tr[data-id]').forEach((row, index) => {
                  order.push({ id: row.dataset.id, sort_order: index + 1 });
                  const badge = row.querySelector('.sort-order-badge');
                  if (badge) badge.textContent = `#${index + 1}`;
              });
              
              fetch(el.dataset.reorderUrl, {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                  },
                  body: JSON.stringify({ items: order })
              }).then(res => res.json()).then(data => {
                  if (typeof toastr !== 'undefined') toastr.success('Order saved successfully!');
              });
          }
      });
  }
  ```

---

## 2. jQuery DataTables Styling & Best Practices
- Initialize tables cleanly:
  ```javascript
  $('#dataTable').DataTable({
      responsive: true,
      pageLength: 25,
      order: [[0, 'asc']],
      language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records..."
      }
  });
  ```
- Wrap tables in Flowbite dark styles: `.border-b .border-white/10 .text-neutral-300`.
- Combine with Toastr for flash messages:
  ```javascript
  toastr.options = {
      positionClass: "toast-top-right",
      timeOut: 4000,
      closeButton: true,
      progressBar: true
  };
  ```
