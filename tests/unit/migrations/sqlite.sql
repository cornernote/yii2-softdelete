/**
 * SQLite
 */

DROP TABLE IF EXISTS "post_a";

CREATE TABLE "post_a" (
  "id" INTEGER NOT NULL PRIMARY KEY,
  "title" TEXT NOT NULL,
  "body" TEXT NOT NULL,
  "deleted_at" INTEGER
);

DROP TABLE IF EXISTS "post_b";

CREATE TABLE "post_b" (
  "id" INTEGER NOT NULL PRIMARY KEY,
  "title" TEXT NOT NULL,
  "body" TEXT NOT NULL,
  "deleted_at" TEXT
);
