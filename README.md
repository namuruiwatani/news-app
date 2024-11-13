# 📰 News Website

![news](https://i.postimg.cc/9M1ZDSn4/news.png)


## 🌟 Roles

1. **Readers** – Regular users who read and interact with the content.
2. **Content Makers** – Users who create and manage their own news posts.
3. **Admins** – Users with full access to site management, including content moderation and user administration.

---

## 🔐 Authorization & Registration

- **Authorization** can be done via Google or by standard email/password authentication.
- **Registration** requires providing a name, email, password, and password confirmation.

After logging in, users are redirected to a specific page based on their role, ensuring streamlined access to relevant features.

---

## 📋 User Features

1. **Profile Management**: Users can view and edit their profile information.
![profile](https://i.postimg.cc/tCrVNmW3/profile.png)
2. **News Viewing**:
   - **News Filtering** by category.
   - **Search** by title or categories.
[![search.png](https://i.postimg.cc/3wBR3t7S/search.png)](https://postimg.cc/JysmqcsZ)
   - **Pagination** for better navigation.
   - **Full Article View**.
[![readmorenews.png](https://i.postimg.cc/Bb9RygFN/readmorenews.png)](https://postimg.cc/tZkrnF2V)
3. **Commenting**:
   - Users can comment on news articles.
   - Comments by admins or content makers have a special label.
[![tecommme.png](https://i.postimg.cc/ryJF20hg/tecommme.png)](https://postimg.cc/fkVhxLQ0)
[![rere.png](https://i.postimg.cc/DwWpkzkm/rere.png)](https://postimg.cc/w1pQDgBd)
4. **Comment Moderation**:
   - Profanity in comments is automatically censored.
[![mat.png](https://i.postimg.cc/K8FWSfYs/mat.png)](https://postimg.cc/qzbw28y8)
5. **Likes & Dislikes** on news articles and comments.
6. **Favorite News**: Users can add or remove news from their favorites list.
7. **Localization**: Supports switching languages: 🇰🇿 Kazakh, 🇷🇺 Russian, 🇺🇸 English.

---

## 🔧 Admin Features

1. **Profile Management**.
2. **News Management (CRUD)**:
   - Add news with a title, content, image, tags, and category.
   - News is marked with the author’s role (Admin/Content Maker).
   - Edit and delete news as needed.
3. **Comment Moderation**:
   - Approve or reject comments containing profanity.
4. **Category Management**: Add and remove categories.
5. **Tag Management**: Add and remove tags.
6. **User Management**:
   - View users and assign roles or delete accounts.
   - Soft-delete functionality allows for account recovery.
[![adminusers.png](https://i.postimg.cc/Ls1z8Kh9/adminusers.png)](https://postimg.cc/bGqGm5QW)

---

## ✏️ Content Maker Features

1. **Profile Management**.
2. **News Management (CRUD)**: Create, edit, and delete their own news posts.
3. **Commenting**: Can write and view comments on news.

---

## 🚀 Installation and Setup

### Requirements
- **PHP** >= 7.4
- **Composer**
- **Laravel** >= 8.x
- **MySQL**
- Local web server (e.g., XAMPP)

### Installation Steps

1. Clone the repository:

   ```bash
   git clone https://github.com/namuruiwatani/news-app.git
   cd https://github.com/namuruiwatani/news-app.git
   ```

2. Install dependencies:

   ```bash
   composer install
   ```

3. Set up the environment file:

   ```bash
   cp .env.example .env
   ```

   Fill in the `.env` file with the following database and Google OAuth configurations:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

   GOOGLE_CLIENT_ID=your_google_client_id
   GOOGLE_CLIENT_SECRET=your_google_client_secret
   GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
   ```

   [Google OAuth Setup Guide](https://support.google.com/cloud/answer/6158849?hl=en)

4. Generate the application key:

   ```bash
   php artisan key:generate
   ```

5. Run migrations and seed the database:

   ```bash
   php artisan migrate --seed
   ```

6. Start the local server:

   ```bash
   php artisan serve
   ```

---

## 🛠 Usage

To run the local server, use:

```bash
php artisan serve
```

For scheduling tasks, configure `php artisan schedule:run` (optional).

### Additional Commands

- Clear configuration cache:

   ```bash
   php artisan config:cache
   ```

- Reset and reseed migrations:

   ```bash
   php artisan migrate:fresh --seed
   ```

---

## 💬 Support

If you encounter any issues, please contact the developers at [dev.namuru@gmail.com](mailto:dev.namuru@gmail.com).

