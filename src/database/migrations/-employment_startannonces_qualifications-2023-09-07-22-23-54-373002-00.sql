-- Adminer 4.8.1 PostgreSQL 14.7 dump

DROP TABLE IF EXISTS "Employment_StartAnnonces_Qualifications";
DROP SEQUENCE IF EXISTS Employment_StartAnnonces_Qualifications_id_seq;
CREATE SEQUENCE Employment_StartAnnonces_Qualifications_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "Employment_StartAnnonces_Qualifications" (
    "id" integer DEFAULT nextval('Employment_StartAnnonces_Qualifications_id_seq') NOT NULL,
    "Annonce_id" integer NOT NULL,
    "Qualification_id" integer NOT NULL,
    "created_at" timestamp DEFAULT now(),
    "updated_at" timestamp,
    "deleted_at" timestamp,
    CONSTRAINT "Employment_StartAnnonces_Qualifications_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "st_qu_indexs" ON "Employment_StartAnnonces_Qualifications" USING btree ("Annonce_id", "Qualification_id");


ALTER TABLE ONLY "Employment_StartAnnonces_Qualifications" ADD CONSTRAINT "e_sa_q_Annonce_id_f_k" FOREIGN KEY ("Annonce_id") REFERENCES "Employment_StartAnnonces"(id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE;
ALTER TABLE ONLY "Employment_StartAnnonces_Qualifications" ADD CONSTRAINT "e_sa_q_Qualification_id_f_k" FOREIGN KEY ("Qualification_id") REFERENCES "Employment_Qualifications"(id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE;
