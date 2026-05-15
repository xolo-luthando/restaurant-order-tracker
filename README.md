# Restaurant Order Tracker API

## Base URL

http://10.166.3.253:8000/

---

# Authentication APIs

## Register User

### Endpoint
POST /register.php

### Parameters
| Name | Type | Description |
|---|---|---|
| name | string | User name |
| password | string | User password |
| role | string | customer or staff |

### Example Response
```json
{
  "status": "success",
  "message": "User registered"
}
```

---

## Login User

### Endpoint
POST /login.php

### Parameters
| Name | Type | Description |
|---|---|---|
| name | string | Username |
| password | string | User password |

### Example Response
```json
{
  "status": "success",
  "message": "Login successful"
}
```

---

# Order APIs

## Add Order

### Endpoint
POST /add_order.php

### Parameters
| Name | Type |
|---|---|
| customer_id | integer |
| staff_id | integer |
| restaurant_id | integer |

---

## Update Order Status

### Endpoint
POST /update_status.php

### Parameters
| Name | Type |
|---|---|
| order_id | integer |
| status | string |

---

## Get Orders

### Endpoint
GET /get_orders.php

### Example Response
```json
[
  {
    "order_id": 1,
    "customer_id": 2,
    "status": "pending"
  }
]
```

---

# Rating APIs

## Rate Order

### Endpoint
POST /rate_order.php

### Parameters
| Name | Type |
|---|---|
| order_id | integer |
| rating | string |

---

# Test Accounts

## Customer
name: Luthando  
password: 1234

## Staff
name: Admin  
password: 1234