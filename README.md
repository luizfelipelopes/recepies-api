# Recipes API - Recipes Management

API for recipe management, allowing creation, reading, updating, and deletion (CRUD).

🚀 **Tecnologias:** Laravel, Pest, SQLite, Sanctum


## 📋 Prerequisites

- Installed Web Server (e.g., Laravel Herd);
- PHP >= 8.2;
- Laravel >= 12.0;
- Installed SQLite;
- Postman (optional, for testing requests).

## 🔧 Instalação

```sh
git clone https://github.com/luizfelipelopes/recepies-api.git
cd recipies-api
composer install
php artisan serve
```

## ⚙️ Configuração

Create a `.env` file from the `.env.example` available in the repository.


## 📡 API Routes

### 🟢 Create Recipe
- **Method:** `POST`
- **URL:** `/api/V1/recipies`
- **Body:**
  ```json
  {
    "title": "Strawberry Soufflé",
    "image": null,
    "ingredients": "Quos dicta earum optio ut eos qui. Dolore tenetur perferendis ex unde. Aspernatur voluptatem cum rerum laboriosam.",
    "instructions": "Atque saepe sint non sunt ut natus. Incidunt et sint deserunt non culpa numquam. Laudantium aut quidem sed ut praesentium et rerum.",
    "category": "breakfast"
  }
  ```
- **Response:**
  ```json
  {
    "id": "12345",
    "title": "Strawberry Soufflé",
    "image": null,
    "ingredients": "Quos dicta earum optio ut eos qui. Dolore tenetur perferendis ex unde. Aspernatur voluptatem cum rerum laboriosam.",
    "instructions": "Atque saepe sint non sunt ut natus. Incidunt et sint deserunt non culpa numquam. Laudantium aut quidem sed ut praesentium et rerum.",
    "category": "breakfast"
  }
  ```

### 🟢 Update Recipe (PUT)
- **Method:** `PUT`
- **URL:** `/api/V1/recipies/12345`
- **Body:**
  ```json
  {
    "title": "Strawberry Soufflé",
    "image": null,
    "ingredients": "Quos dicta earum optio ut eos qui. Dolore tenetur perferendis ex unde. Aspernatur voluptatem cum rerum laboriosam.",
    "instructions": "Atque saepe sint non sunt ut natus. Incidunt et sint deserunt non culpa numquam. Laudantium aut quidem sed ut praesentium et rerum.",
    "category": "breakfast"
  }
  ```
- **Response:**
  ```json
  {
    "id": "12345",
    "title": "Strawberry Soufflé",
    "image": null,
    "ingredients": "Quos dicta earum optio ut eos qui. Dolore tenetur perferendis ex unde. Aspernatur voluptatem cum rerum laboriosam.",
    "instructions": "Atque saepe sint non sunt ut natus. Incidunt et sint deserunt non culpa numquam. Laudantium aut quidem sed ut praesentium et rerum.",
    "category": "breakfast"
  }
  ```

### 🟢 Update Recipe (PATCH)
- **Method:** `PATCH`
- **URL:** `/api/V1/recipies/12345`
- **Body:**
  ```json
  {
    "title": "Avocado Soufflé"
  }
  ```
- **Response:**
  ```json
  {
    "id": "12345",
    "title": "Avocado Soufflé",
    "image": null,
    "ingredients": "Quos dicta earum optio ut eos qui. Dolore tenetur perferendis ex unde. Aspernatur voluptatem cum rerum laboriosam.",
    "instructions": "Atque saepe sint non sunt ut natus. Incidunt et sint deserunt non culpa numquam. Laudantium aut quidem sed ut praesentium et rerum.",
    "category": "breakfast"
  }
  ```

### 🔵 List Recipes
- **Method:** `GET`
- **URL:** `/api/V1/recipies`
- **Response:**
  ```json
  {
    "data": [
        {
            "id": 1,
            "title": "Avocado Soufflé",
            "image": null,
            "ingredients": "Quos dicta earum optio ut eos qui. Dolore tenetur perferendis ex unde. Aspernatur voluptatem cum rerum laboriosam.",
            "instructions": "Atque saepe sint non sunt ut natus. Incidunt et sint deserunt non culpa numquam. Laudantium aut quidem sed ut praesentium et rerum.",
            "category": "breakfast"
        },
        {
            "id": 2,
            "title": "Strawberry Soufflé",
            "image": "https://via.placeholder.com/640x480.png/001155?text=ipsam",
            "ingredients": "Maiores optio cupiditate qui. Sequi provident deserunt ipsa harum. Qui modi dolorum et sapiente. Non reprehenderit ea molestiae laudantium deserunt.",
            "instructions": "Natus aut et omnis minus mollitia sit. Pariatur doloremque a nemo. Officiis ut nobis culpa consequatur maiores.",
            "category": "lunch"
        },
        {
            "id": 3,
            "title": "Mr.",
            "image": null,
            "ingredients": "In sit illo distinctio quia omnis ducimus. Voluptatem quas deserunt voluptatem placeat itaque. Architecto temporibus autem cupiditate officiis adipisci itaque.",
            "instructions": "Nisi eligendi numquam officiis nihil qui. Minima fugit illo omnis quisquam commodi commodi in. Quia quod omnis maiores cum quis. Dolores eos quo qui rerum ipsum ut alias.",
            "category": "lunch"
        },
        {
            "id": 4,
            "title": "Miss",
            "image": "https://via.placeholder.com/640x480.png/0088aa?text=quae",
            "ingredients": "Mollitia sequi aspernatur sit dignissimos quaerat. Est ut eveniet laudantium nesciunt placeat facere.",
            "instructions": "Dolores a inventore nisi. Quo cupiditate vitae dicta tenetur. Quam vero recusandae eos minima magni nihil.",
            "category": "lunch"
        },
        {
            "id": 5,
            "title": "Dr.",
            "image": null,
            "ingredients": "Vero eum eligendi doloribus totam omnis eos. Necessitatibus itaque reprehenderit unde quae. Nam aut ad fuga rerum. Odit voluptatum omnis molestiae eius blanditiis velit non qui.",
            "instructions": "Cum ullam et perferendis est. Officiis provident molestiae maxime aut quos. Neque amet laboriosam illo.",
            "category": "dinner"
        },
        {
            "id": 6,
            "title": "Dr.",
            "image": null,
            "ingredients": "Vel assumenda magnam maiores illo. Et aperiam repellendus nisi ut voluptates dolores beatae accusamus. Vero ratione itaque voluptatibus quia velit.",
            "instructions": "Minus dignissimos enim sed rerum ea. Perspiciatis unde aperiam velit aliquid sit. Sunt cupiditate maxime velit sit magnam recusandae nihil. Architecto culpa incidunt magni quas facilis.",
            "category": "breakfast"
        },
        {
            "id": 7,
            "title": "Mr.",
            "image": null,
            "ingredients": "Rerum ea et sunt accusamus qui. Dolorem minus assumenda id tenetur est deserunt. Quia dolorem assumenda itaque ut.",
            "instructions": "Sed quae dolor omnis. Iusto delectus necessitatibus error dolor voluptatum soluta. Consectetur molestiae beatae nobis.",
            "category": "dinner"
        },
        {
            "id": 8,
            "title": "Dr.",
            "image": "https://via.placeholder.com/640x480.png/00ff99?text=aliquam",
            "ingredients": "Perferendis pariatur deserunt id et saepe. Optio unde explicabo qui. Ut voluptatem natus et iure necessitatibus optio sed mollitia. Sunt repudiandae aspernatur aliquid aut eius eos.",
            "instructions": "A blanditiis laborum dolorem assumenda iure iste. Id voluptas ut sit aliquid inventore molestias. Optio impedit accusamus magni amet omnis quae mollitia.",
            "category": "breakfast"
        },
        {
            "id": 9,
            "title": "Dr.",
            "image": null,
            "ingredients": "Enim in cupiditate dignissimos hic. Aliquid eos quaerat repellendus fugit voluptas quo. Sit qui et laboriosam enim dolores qui.",
            "instructions": "Odit hic aut recusandae quis laudantium. Impedit laudantium necessitatibus dignissimos quaerat autem voluptatibus dolor. Numquam repellat eveniet temporibus voluptatum explicabo optio.",
            "category": "breakfast"
        },
        {
            "id": 11,
            "title": "Prof.",
            "image": null,
            "ingredients": "Quos dicta earum optio ut eos qui. Dolore tenetur perferendis ex unde. Aspernatur voluptatem cum rerum laboriosam.",
            "instructions": "Atque saepe sint non sunt ut natus. Incidunt et sint deserunt non culpa numquam. Laudantium aut quidem sed ut praesentium et rerum.",
            "category": "breakfast"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/V1/recipies?page=1",
        "last": "http://localhost:8000/api/V1/recipies?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/V1/recipies?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/V1/recipies",
        "per_page": 10,
        "to": 10,
        "total": 10
    }
  }
  ```

### 🔵 Get Recipe Details
- **Method:** `GET`
- **URL:** `/api/V1/recipies/12345`
- **Response:**
  ```json
  {
    "id": 12345,
    "title": "Avocado Soufflé",
    "image": null,
    "ingredients": "Quos dicta earum optio ut eos qui. Dolore tenetur perferendis ex unde. Aspernatur voluptatem cum rerum laboriosam.",
    "instructions": "Atque saepe sint non sunt ut natus. Incidunt et sint deserunt non culpa numquam. Laudantium aut quidem sed ut praesentium et rerum.",
    "category": "breakfast"
  }
  ```

## 🔑 Authentication

To access protected routes, obtain a token from: `/api/V1/recipies/setup`

```json
{
    "admin": "1|uwTBpPHoq0RENh7BsmvaAD3ALzFXKJ2ltFTYnkpBff40590d",
    "crud": "2|CYOpGDQS3zNPAc2ImFqSv6M9STLzMEbHExVd0Fgm3ea4a6e5",
    "basic": "3|dB8sBNKBOa2f0MdREDpMSxDoUTdJnYHoU9JJbNlv04e85fe4"
}
```

- **admin:** Full access to all functionalities
- **crud:** Access to create, update, and delete functionalities
- **basic:** Read-only access to recipes list and details

Use the token in the request header:

```sh
Authorization: Bearer SEU_TOKEN_AQUI
```


## ⚠️ Response Codes

- `200 OK` – Request successful
- `201 Created` – Resource successfully created
- `400 Bad Request` – Invalid request
- `401 Unauthorized` – Token not provided or invalid
- `404 Not Found` – Resource not found
- `500 Internal Server Error` – Unexpected server error


## 🧪 Testing

To run the tests:

```sh
php artisan test
```


