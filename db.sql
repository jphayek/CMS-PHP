-- Adminer 4.8.1 PostgreSQL 15.2 (Debian 15.2-1.pgdg110+1) dump

DROP TABLE IF EXISTS "categories";
DROP SEQUENCE IF EXISTS categories_id_seq;
CREATE SEQUENCE categories_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."categories" (
    "id" integer DEFAULT nextval('categories_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    CONSTRAINT "categories_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


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
    "category_id" integer NOT NULL,
    CONSTRAINT "article_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_article" ("id", "title", "content", "created_at", "updated_at", "author", "category_id") VALUES
(1,	'Test',	'Article1',	'2023-06-29 07:43:22.489591',	NULL,	0,	1),
(2,	'Qwrqwr',	'qwrqwr',	'2023-08-02 19:00:00.654245',	NULL,	4,	2),
(30,	'Tet',	'tet',	'2023-09-03 14:34:28.492794',	NULL,	4,	3),
(9,	'Uu',	'uu',	'2023-06-30 12:40:12.036204',	NULL,	5,	2),
(3,	'Js',	'JavaScript',	'2023-06-29 07:43:22.489591',	NULL,	0,	3),
(37,	'Title',	'content',	'2023-09-03 14:38:53.329486',	NULL,	4,	1),
(8,	'Rr',	'rr',	'2023-06-30 12:36:34.583679',	NULL,	5,	1),
(101,	'Tqt',	'tesss',	'2023-09-03 16:22:13.496648',	NULL,	4,	1),
(102,	'Qwrq',	'qwrq',	'2023-09-03 16:22:16.54114',	NULL,	4,	1),
(104,	'Test',	'TTTTTTTTTTTTTTT',	'2023-09-03 16:22:57.3725',	NULL,	4,	1),
(105,	'Test',	'TESTTTTTTTTTTT',	'2023-09-03 16:23:06.599716',	NULL,	4,	1),
(106,	'Test',	'TESTTTTTTTTTTT',	'2023-09-03 16:24:05.990339',	NULL,	4,	1),
(107,	'Qqqqqqqqqqqqqq',	'qqqqqqqqqqqqqqqqq',	'2023-09-03 16:24:10.356958',	NULL,	4,	1),
(108,	'Qqqqqqqqqqqqqq',	'qqqqqqqqqqqqqqqqq',	'2023-09-03 16:25:20.076661',	NULL,	4,	1),
(109,	'Un Test',	'test',	'2023-09-03 16:51:53.939158',	NULL,	4,	1),
(110,	'Article',	'article',	'2023-09-03 16:52:21.619536',	NULL,	4,	1),
(111,	'Testt',	'tetst',	'2023-09-05 20:16:52.874659',	NULL,	4,	1),
(22,	'Title',	'Content',	'2023-09-03 14:28:21.133896',	NULL,	4,	1),
(28,	'Tet',	'tet',	'2023-09-03 14:33:32.262598',	NULL,	4,	1),
(33,	'Title',	'tet',	'2023-09-03 14:34:58.480321',	NULL,	4,	1),
(34,	'Title Test',	'Content test',	'2023-09-03 14:36:46.716196',	NULL,	4,	1),
(35,	'Title Test',	'Content test',	'2023-09-03 14:37:56.324241',	NULL,	4,	1),
(36,	'Title Test',	'Content test',	'2023-09-03 14:38:44.723826',	NULL,	4,	1),
(38,	'Title',	'content',	'2023-09-03 14:40:44.935259',	NULL,	4,	1),
(39,	'Title',	'Content',	'2023-09-03 14:40:54.506701',	NULL,	4,	1),
(40,	'Title',	'Content',	'2023-09-03 14:41:30.368703',	NULL,	4,	1),
(112,	'Sport',	'sport',	'2023-09-05 21:15:12.350686',	NULL,	4,	1),
(113,	'Blog',	'blog',	'2023-09-05 21:16:00.686448',	NULL,	4,	2),
(114,	'Other',	'other',	'2023-09-05 21:16:24.860049',	NULL,	4,	3),
(115,	'Sport1',	'Sport1',	'2023-09-05 23:17:50.058299',	NULL,	4,	1);

DROP TABLE IF EXISTS "esgi_comment";
DROP SEQUENCE IF EXISTS esgi_comment_id_seq;
CREATE SEQUENCE esgi_comment_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_comment" (
    "id" integer DEFAULT nextval('esgi_comment_id_seq') NOT NULL,
    "article_id" integer NOT NULL,
    "user_id" integer NOT NULL,
    "content" text,
    "created_at" timestamp DEFAULT CURRENT_TIMESTAMP,
    "moderated" integer DEFAULT '0',
    "flagged" integer DEFAULT '0',
    "flagged_count" integer DEFAULT '0',
    CONSTRAINT "esgi_comment_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


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
    "status" integer DEFAULT '0' NOT NULL,
    CONSTRAINT "pages_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


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


ALTER TABLE ONLY "public"."esgi_article" ADD CONSTRAINT "esgi_article_category_id_fkey" FOREIGN KEY (category_id) REFERENCES categories(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_comment" ADD CONSTRAINT "esgi_comment_article_id_fkey" FOREIGN KEY (article_id) REFERENCES esgi_article(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_comment" ADD CONSTRAINT "esgi_comment_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_user(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_pages" ADD CONSTRAINT "fk_page_created_by" FOREIGN KEY (created_by) REFERENCES esgi_user(id) ON DELETE CASCADE NOT DEFERRABLE;

-- 2023-09-08 22:24:26.408069+00