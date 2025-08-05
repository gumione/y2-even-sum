# Even Sum API

A small REST API built with Yii2 and PHP 8.3+ that returns the sum of even numbers from a JSON array.

---

## Installation

1. **Clone the repository**  
   ```bash
   git clone git@github.com:gumione/y2-even-sum.git
   ```

   ```bash
   cd y2-even-sum
   ```

2. **Install PHP dependencies (optional)**  
   ```bash
   composer install
   ```  
   This step is only required if you plan to run the app locally without Docker. The Docker build process automatically installs dependencies.

3. **Set up environment (optional)**  
   ```bash
   cp .env.example .env
   ```  

4. **Start the application with Docker Compose**  
   ```bash
   docker compose up --build -d
   ```  
   API will be available at `http://localhost:8000`

---

## Usage Examples

### Calculate sum of even numbers
```bash
curl -X POST http://localhost:8000/sum-even \
     -H "Content-Type: application/json" \
     -d '{"numbers":[1,2,3,4,5,6]}'
# Response: {"sum":12}
```

### Swagger UI
Open in browser:  
```
http://localhost:8000/swagger
```

### OpenAPI JSON
```
http://localhost:8000/swagger/json
```

---

## Project Structure

```
yii2-even-sum-api/
├── config/
│   └── web.php
├── controllers/
│   ├── SumController.php
│   └── SwaggerController.php
├── dto/
│   └── NumberCollectionDto.php
├── services/
│   ├── interfaces/
│   │   └── SumCalculatorInterface.php
│   └── EvenSumCalculator.php
├── tests/
│   ├── unit/
│   │   └── Services/EvenSumCalculatorTest.php
│   └── functional/
│       └── Controllers/SumControllerTest.php
├── web/
│   └── index.php
├── docker/
│   ├── php/Dockerfile
│   └── nginx/default.conf
├── docker-compose.yml
├── composer.json
└── .env.example
```
