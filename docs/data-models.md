# Data Models — SendFlow

## Entity Relationship Overview

### contacts
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| email | string | unique |
| first_name | string | nullable |
| last_name | string | nullable |
| company | string | nullable |
| phone | string | nullable |
| birthday | date | nullable |
| street | string | nullable |
| address2 | string | nullable |
| city | string | nullable |
| region | string | nullable |
| postal | string | nullable |
| country | string | nullable |
| permission | boolean | nullable |
| subscribed | boolean | nullable |
| created_at | timestamp | |
| updated_at | timestamp | |

Relationships: belongsToMany(tags via `contact_tag`), belongsToMany(campaigns via `campaign_contact`)

### tags
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| name | string | |
| created_at | timestamp | |
| updated_at | timestamp | |

Relationships: belongsToMany(contacts via `contact_tag`), belongsToMany(campaigns via `campaign_tag`)

### contact_tag (pivot)
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| contact_id | bigint | FK → contacts, cascade delete |
| tag_id | bigint | FK → tags, cascade delete |
| created_at | timestamp | |
| updated_at | timestamp | |

### campaigns
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| name | string | |
| type | enum('regular','automation') | default: regular |
| status | enum('draft','scheduled','sent') | default: draft |
| send_date | date | nullable |
| template_id | bigint | FK → message_templates |
| contact_id | bigint | FK → contacts, nullable |
| created_by | string | nullable |
| sent_at | timestamp | nullable |
| created_at | timestamp | |
| updated_at | timestamp | |

Relationships: belongsTo(template), belongsTo(contact), belongsToMany(contacts via `campaign_contact`), belongsToMany(tags via `campaign_tag`)

### campaign_contact (pivot)
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| campaign_id | bigint | FK → campaigns |
| contact_id | bigint | FK → contacts |
| created_at | timestamp | |
| updated_at | timestamp | |

### campaign_tag (pivot)
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| campaign_id | bigint | FK → campaigns |
| tag_id | bigint | FK → tags |
| created_at | timestamp | |
| updated_at | timestamp | |

### message_templates
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| name | string | |
| subject | string | nullable |
| body | text | HTML content |
| created_at | timestamp | |
| updated_at | timestamp | |

Relationships: hasMany(campaigns)

### automations
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| name | string | |
| description | string | nullable, max 500 |
| trigger_type | enum('contact_created','tag_added','birthday','date_based') | |
| trigger_config | json | nullable |
| status | enum('active','paused') | default: active |
| created_at | timestamp | |
| updated_at | timestamp | |

Relationships: hasMany(steps), hasMany(logs)

### automation_steps
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| automation_id | bigint | FK → automations |
| order | integer | step ordering |
| delay_days | integer | min: 0 |
| action_type | enum('send_email','add_tag','remove_tag') | |
| action_config | json | nullable (template_id / tag_id) |
| created_at | timestamp | |
| updated_at | timestamp | |

Relationships: belongsTo(automation), hasMany(logs)

### automation_logs
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| automation_id | bigint | FK → automations |
| step_id | bigint | FK → automation_steps |
| contact_id | bigint | FK → contacts |
| status | enum('pending','completed','failed') | |
| error | text | nullable |
| processed_at | timestamp | nullable |
| created_at | timestamp | |
| updated_at | timestamp | |

Relationships: belongsTo(automation), belongsTo(step), belongsTo(contact)

### messages (Inbox)
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| ... | (additional columns from migration) | |
| created_at | timestamp | |
| updated_at | timestamp | |

### labels
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| name | string | |
| created_at | timestamp | |
| updated_at | timestamp | |

### sources
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| name | string | |
| created_at | timestamp | |
| updated_at | timestamp | |

### api_contacts
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| ... | (API-specific fields) | |
| created_at | timestamp | |
| updated_at | timestamp | |

### users
| Column | Type | Constraints |
|---|---|---|
| id | bigint (auto) | PK |
| name | string | |
| email | string | unique |
| password | string | hashed |
| avatar | string | nullable |
| ... | (Sanctum + standard Laravel fields) | |
| created_at | timestamp | |
| updated_at | timestamp | |
