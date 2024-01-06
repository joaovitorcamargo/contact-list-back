# Step by step to execute the project

-   Copy and rename the .env.example file to .env
-   Configure in .env DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
-   Run the composer install command
-   Run the php artisan key:generate command
-   Run the php artisan migrate command
-   run the php artisan serve command

# Documentation Link

-   https://documenter.getpostman.com/view/10580830/2s9YsGiDEy

# Test Title

Contact List API

## Functional Requirements

-   [x] Create a new people
-   [x] Edit existing people details
-   [x] Remove a people
-   [x] View specific people details
-   [x] Create a new contact for a people
-   [] Edit existing contact details for a people
-   [] Remove a contact from a people
-   [] View specific contact details for a people

## Business Rules

### People Management:
-   [x] Users can create, update, retrieve, and delete people records.
-   [] Each people can have multiple contacts (phone, email, WhatsApp, etc.).
### Contact Management:
-   [x] Users can create, update, retrieve, and delete contact details for a people.
-   [] Contact details may include various types such as phone, email, whatsapp.
### Data Integrity and Validation:
-   [x] A person cannot have duplicate records based on email or any other unique identifier.
-   [x] Validation to ensure that contact details entered are in the correct format (e.g., valid email address format, proper phone number format).
### Relationship Management:
- [x] Establish a relationship between a person and their contacts, allowing efficient retrieval and management of contacts associated with a particular person.
