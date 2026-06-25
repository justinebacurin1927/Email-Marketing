# API Contracts — SendFlow

## REST API (`/api/`)

### GET /api/contacts
Returns all contacts.

**Response:**
```json
[
  {
    "id": 1,
    "email": "alice@example.com",
    "first_name": "Alice",
    "last_name": "Smith",
    "subscribed": true,
    "tags": [...]
  }
]
```

### POST /api/contacts
Create a new contact.

**Request:**
```json
{
  "email": "new@example.com",
  "first_name": "New",
  "last_name": "Contact",
  "subscribed": true
}
```

**Response:** 201 Created

## Web Routes (non-API, Blade-rendered)

### Dashboard
| Method | Path | Description |
|---|---|---|
| GET | `/` | Dashboard with stats, charts, recent campaigns |

### Campaigns
| Method | Path | Description |
|---|---|---|
| GET | `/campaigns` | List all campaigns |
| GET | `/campaigns/create` | Campaign creation form |
| POST | `/campaigns` | Create campaign |
| GET | `/campaigns/{id}/edit` | Edit form |
| PUT | `/campaigns/{id}` | Update campaign |
| DELETE | `/campaigns/{id}` | Delete campaign |
| POST | `/campaigns/{id}/send` | Send campaign immediately |
| GET | `/campaigns/{id}/preview` | Email preview page |
| POST | `/campaigns/{id}/duplicate` | Duplicate campaign |
| GET | `/campaigns/{id}/view-email` | View rendered email |

### Automations
| Method | Path | Description |
|---|---|---|
| GET | `/automations` | List all automation workflows |
| GET | `/automations/create` | Create form |
| POST | `/automations` | Store automation |
| GET | `/automations/{id}/edit` | Edit form |
| PUT | `/automations/{id}` | Update automation |
| DELETE | `/automations/{id}` | Delete automation |
| POST | `/automations/{id}/toggle` | Pause/activate workflow |

### Audience
| Method | Path | Description |
|---|---|---|
| GET | `/audience` | Contacts list |
| GET | `/add-contact` | Create contact form |
| POST | `/contacts` | Store contact |
| PUT | `/contacts/{id}` | Update contact |
| DELETE | `/contacts/delete-selected` | Bulk delete contacts |
| GET | `/import-contacts` | CSV import form |
| POST | `/import-contacts` | Execute CSV import |
| GET | `/contacts/export` | Export contacts as CSV |
| GET | `/audience/inbox` | Message inbox |
| GET | `/audience/audience-tags` | Tag management |
| GET | `audience/add-labels` | Label management |
| GET | `/add-source` | Source management |

### Templates
| Method | Path | Description |
|---|---|---|
| GET | `/message-temp` | List templates |
| GET | `/template-form` | Create template form |
| POST | `/template-form` | Store template |
| GET | `/template-form/{id}/edit` | Edit template |
| PUT | `/template-form/{id}` | Update template |
| DELETE | `/template-form/{id}` | Delete template |

### Profile
| Method | Path | Description |
|---|---|---|
| GET | `/profile` | Profile page |
| PUT | `/profile` | Update profile |
| PUT | `/profile/password` | Change password |
| POST | `/profile/avatar` | Upload avatar |
| DELETE | `/profile/avatar` | Remove avatar |

## Authentication

Session-based authentication via Laravel's built-in auth scaffolding. API uses Laravel Sanctum token-based authentication.
