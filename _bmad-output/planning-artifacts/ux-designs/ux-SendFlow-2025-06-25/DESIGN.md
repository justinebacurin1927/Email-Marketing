---
colors:
  navy: "#1a1a2e"
  navy-light: "#16213e"
  coral: "#e94560"
  coral-dark: "#c23152"
  purple: "#533483"
  deep-blue: "#0f3460"
  white: "#ffffff"
  gray-100: "#f3f4f6"
  gray-200: "#e5e7eb"
  gray-300: "#d1d5db"
  gray-400: "#9ca3af"
  gray-500: "#6b7280"
  gray-700: "#374151"
  gray-900: "#111827"
  green: "#10b981"
  yellow: "#f59e0b"
  blue: "#3b82f6"
  red: "#ef4444"
typography:
  family: system-ui, -apple-system, sans-serif
  scale: [12, 14, 16, 18, 20, 24, 30]
rounded:
  sm: 4
  md: 6
  lg: 8
  xl: 12
  full: 9999
spacing:
  unit: 4
  scale: [0, 4, 8, 12, 16, 20, 24, 32, 40, 48, 64]
components:
  Sidebar: {bg: colors.navy, width: 260, text: colors.gray-300, hover-text: colors.white, active-bg: colors.deep-blue, icon-size: 20}
  Topbar: {bg: colors.white, border-bottom: colors.gray-200, height: 64, text: colors.gray-900}
  StatCard: {bg: gradient, border-radius: rounded.lg, padding: spacing.24, text-primary: colors.white, text-secondary: colors.gray-300}
  Badge: {border-radius: rounded.full, padding: "4 12", font-size: 12}
  Button: {border-radius: rounded.md, padding: "8 16", font-size: 14}
  Table: {header-bg: colors.gray-100, row-hover: colors.gray-100, border: colors.gray-200}
  Card: {bg: colors.white, border-radius: rounded.lg, shadow: sm, padding: spacing.24}
---

# SendFlow — DESIGN.md

## Brand & Style

SendFlow is an email marketing platform with a professional, modern aesthetic. The brand communicates reliability and performance through a dark navy/coral palette with clean typography and generous whitespace.

*Voice: Professional, direct, capable. Microcopy avoids marketing fluff — operators need clarity, not persuasion.*

## Colors

| Token | Value | Usage |
|---|---|---|
| navy / `colors.navy` | `#1a1a2e` | Sidebar background, dark sections |
| navy-light / `colors.navy-light` | `#16213e` | Secondary dark backgrounds |
| coral / `colors.coral` | `#e94560` | Primary accent, buttons, active indicators |
| coral-dark / `colors.coral-dark` | `#c23152` | Hover state for coral elements |
| purple / `colors.purple` | `#533483` | Highlight accent, secondary branding |
| deep-blue / `colors.deep-blue` | `#0f3460` | Sidebar active item, card backgrounds |
| green / `colors.green` | `#10b981` | Sent/success status |
| yellow / `colors.yellow` | `#f59e0b` | Draft/pending status |
| blue / `colors.blue` | `#3b82f6` | Scheduled status, links |

## Typography

System font stack (`system-ui, -apple-system, sans-serif`). No custom fonts.

Scale: 12px (label), 14px (body), 16px (body-large), 18px (subheading), 20px (heading-3), 24px (heading-2), 30px (heading-1).

## Layout & Spacing

- **Sidebar:** Fixed left, 260px wide, full height. Contains SendFlow branding, navigation links with icons, user section at bottom.
- **Topbar:** Full-width bar above content area. Contains page title, user avatar/menu, clock.
- **Content area:** Flexible right section next to sidebar. Contains page-specific content.
- **Spacing unit:** 4px base. Cards use 24px padding. Section gaps use 32px.

## Elevation & Depth

- Cards use subtle box shadows (`shadow-sm` equivalent).
- Stat cards use dark gradient backgrounds for depth without shadow.
- Sidebar has a right border to separate from content. Sidebar items have hover and active background states.

## Shapes

- Cards: 8px border radius.
- Buttons: 6px border radius.
- Badges: Fully rounded (pill shape).
- Inputs: 6px border radius.

## Components

### Sidebar
- Background: navy (`#1a1a2e`)
- Width: 260px
- Navigation text: gray-300, hover → white
- Active item: deep-blue background
- Brand logo/name at top
- Navigation items with 20px icons
- User profile link at bottom

### Stat Cards
- Gradient background (dark tones)
- White primary stat text
- Gray secondary label text
- 8px border radius
- 24px padding
- Display: count number + label

### Badges
- Pill shape (full border radius)
- Sent: green background + white text
- Draft: yellow background + white text
- Scheduled: blue background + white text
- 12px font, 4px/12px padding

### Buttons
- 6px border radius
- Primary: coral background, white text
- Secondary: outlined or gray background
- 14px font, 8px/16px padding

### Tables
- Light gray header row
- Hover highlight on rows
- Subtle borders
- Used for campaigns, contacts, automations lists

### Cards
- White background
- 8px border radius
- Subtle shadow
- 24px padding
- Used for forms, detail views, settings

## Do's and Don'ts

- **Do** use the navy/coral palette consistently — dark sidebar, coral accents.
- **Do** use status badges to communicate campaign state at a glance.
- **Don't** introduce additional accent colors — coral is the primary action color.
- **Don't** use custom fonts — system stack keeps load times minimal.
- **Do** maintain generous whitespace around cards and content sections.
