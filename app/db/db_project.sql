PGDMP         ;                z            produksi    14.1    14.1     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    67238    produksi    DATABASE     k   CREATE DATABASE produksi WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Indonesian_Indonesia.1252';
    DROP DATABASE produksi;
                postgres    false            �            1259    67240    msuser    TABLE     |  CREATE TABLE public.msuser (
    userid integer NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    last_login timestamp without time zone,
    createddate timestamp without time zone NOT NULL,
    createdby character varying(255) NOT NULL,
    updateddate timestamp without time zone,
    updatedby character varying(255)
);
    DROP TABLE public.msuser;
       public         heap    postgres    false            �            1259    67239    msuser_userid_seq    SEQUENCE     �   CREATE SEQUENCE public.msuser_userid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.msuser_userid_seq;
       public          postgres    false    210            �           0    0    msuser_userid_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.msuser_userid_seq OWNED BY public.msuser.userid;
          public          postgres    false    209            \           2604    67243    msuser userid    DEFAULT     n   ALTER TABLE ONLY public.msuser ALTER COLUMN userid SET DEFAULT nextval('public.msuser_userid_seq'::regclass);
 <   ALTER TABLE public.msuser ALTER COLUMN userid DROP DEFAULT;
       public          postgres    false    210    209    210            �          0    67240    msuser 
   TABLE DATA           x   COPY public.msuser (userid, username, password, last_login, createddate, createdby, updateddate, updatedby) FROM stdin;
    public          postgres    false    210   �       �           0    0    msuser_userid_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.msuser_userid_seq', 2, true);
          public          postgres    false    209            ^           2606    67247    msuser msuser_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.msuser
    ADD CONSTRAINT msuser_pkey PRIMARY KEY (userid);
 <   ALTER TABLE ONLY public.msuser DROP CONSTRAINT msuser_pkey;
       public            postgres    false    210            �   �   x�mͻ�0@�}
V��)�l@c"A�@�"W�<�:�8��|E��R"	�D�T��'�����G�/{9�iq%m!ȡ�M����d��Y��]�BmL�CC�~���Pߦ�/c�!��jêNo2����L��6/�S_�U��yݤ�����[���~�P�� ��;x     