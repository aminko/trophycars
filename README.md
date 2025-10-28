### Installation

Add .env file, for example:
`cp .env.example .env`

Run docker image:
`docker-compose up -d`

Once completed, service should be running on http://localhost:8000

By default, database is empty. You can populate it with command:
`./dev seed`

To reset database:
`./dev migrate`

## Frontend

To setup fronted, run following commands:

```bash npm install && npm run dev```

At this point, you should be able to access the frontend at http://localhost:8000
