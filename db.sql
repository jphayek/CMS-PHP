-- Adminer 4.8.1 PostgreSQL 15.2 (Debian 15.2-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_user";
DROP SEQUENCE IF EXISTS esgi_user_id_seq;
CREATE SEQUENCE esgi_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_user" (
    "id" integer DEFAULT nextval('esgi_user_id_seq') NOT NULL,
    "firstname" character varying NOT NULL,
    "lastname" character varying NOT NULL,
    "email" character varying NOT NULL,
    "pwd" character varying NOT NULL,
    "country" character varying,
    "status" integer,
    "date_inserted" timestamp,
    "date_updated" timestamp,
    "role" character varying NOT NULL,
    "verificationtoken" character varying(100),
    CONSTRAINT "esgi_user_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_user" ("id", "firstname", "lastname", "email", "pwd", "country", "status", "date_inserted", "date_updated", "role", "verificationtoken") VALUES
(1,	'Jean-paul',	'HAYEK',	'jphayek@user.com',	'$2y$10$jDveAzEtjzitGlyEj/d0gu8FlGnFwQrM9f2SyAWsEhXhwb/uZN56W',	NULL,	0,	NULL,	NULL,	'user',	'fcb68109d992fa156e377006aa3931cd9fd54b6b53d61db8d5538b0a6294cbe9934ab50fe0577b4fd0e193a0f47209a855e7'),
(2,	'Test',	'USER',	'test@user.com',	'$2y$10$RFkilW6oFze3u9eNY7RLxeCYxm4/biazvyrucs0u9czPAC7HnxlRS',	NULL,	1,	NULL,	NULL,	'user',	'c09a4ed9d53ca2291839fa1776e12d31ba6e617c554b8cee74016469f4b0c826d4a3d0a616ee451212d1c5a2160980f51731'),
(3,	'Jean-paul',	'HAYEK',	'jphayek@myges.fr',	'$2y$10$9w16xcdZftf0ccGQR1s6aOvHM8Dke0oKFwqKBTW.xOb9JNnIeYYrm',	NULL,	0,	NULL,	NULL,	'admin',	'8d9de25d4a7627d69bbb644ff97649da58422d0520cb1210546a26faef191dc8410eb4444f25d5a73354c04410f53efb443d');
-- 2023-06-28 09:53:25.240648+00



-- Adminer 4.8.1 PostgreSQL 15.2 (Debian 15.2-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_article";
DROP SEQUENCE IF EXISTS article_id_seq;
CREATE SEQUENCE article_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_article" (
    "id" integer DEFAULT nextval('article_id_seq') NOT NULL,
    "title" character varying(255) NOT NULL,
    "content" text NOT NULL,
    "created_at" timestamp DEFAULT CURRENT_TIMESTAMP,
    "updated_at" timestamp,
    "author" integer NOT NULL,
    CONSTRAINT "article_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_article" ("id", "title", "content", "created_at", "updated_at", "author") VALUES
(1,	'Test',	'Article1',	'2023-06-29 07:43:22.489591',	NULL,	0),
(3,	'Js',	'JavaScript',	'2023-06-29 07:43:22.489591',	NULL,	0),
(8,	'Rr',	'rr',	'2023-06-30 12:36:34.583679',	NULL,	5),
(9,	'Uu',	'uu',	'2023-06-30 12:40:12.036204',	NULL,	5);

-- 2023-06-30 12:47:39.586761+00


DROP TABLE IF EXISTS "esgi_pages";
DROP SEQUENCE IF EXISTS pages_id_seq;
CREATE SEQUENCE pages_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

/*CREATE TABLE "public"."esgi_pages" (
    "id" integer DEFAULT nextval('pages_id_seq') NOT NULL,
    "title" character varying(255) NOT NULL,
    "content" text NOT NULL,
    "created_at" timestamp DEFAULT CURRENT_TIMESTAMP,
    "updated_at" timestamp,
    CONSTRAINT "pages_pkey" PRIMARY KEY ("id")

) WITH (oids = false);4

) WITH (oids = false);*/


DROP TABLE IF EXISTS "esgi_comment";
DROP SEQUENCE IF EXISTS comment_id_seq;
CREATE SEQUENCE comment_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE esgi_comment (
  id SERIAL PRIMARY KEY,
  article_id INT NOT NULL,
  user_id INT NOT NULL,
  content TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  moderated INT DEFAULT 0,
  flagged INT DEFAULT 0,
  flagged_count INT DEFAULT 0,
  FOREIGN KEY (article_id) REFERENCES esgi_article(id),
  FOREIGN KEY (user_id) REFERENCES esgi_user(id)
);


DROP TABLE IF EXISTS "esgi_pages";
DROP SEQUENCE IF EXISTS pages_id_seq;

CREATE SEQUENCE pages_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_pages" (
    "id" integer DEFAULT nextval('pages_id_seq') NOT NULL,
    "title" character varying(255) NOT NULL,
    "content" text NOT NULL,
    "created_at" timestamp DEFAULT CURRENT_TIMESTAMP,
    "updated_at" timestamp,
    "created_by" integer NOT NULL,
    "slug" character varying(255),
    "status" integer DEFAULT 0 NOT NULL,
    CONSTRAINT "pages_pkey" PRIMARY KEY ("id")
) WITH (oids = false);




ALTER TABLE ONLY "public"."esgi_pages" ADD CONSTRAINT "fk_page_created_by" FOREIGN KEY (created_by) REFERENCES esgi_user(id) ON DELETE CASCADE NOT DEFERRABLE;
