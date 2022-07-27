PGDMP         #                z            produksi    14.1    14.1                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    67238    produksi    DATABASE     k   CREATE DATABASE produksi WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Indonesian_Indonesia.1252';
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
       public          postgres    false    210                       0    0    msuser_userid_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.msuser_userid_seq OWNED BY public.msuser.userid;
          public          postgres    false    209            �            1259    75482    productionorder    TABLE     �  CREATE TABLE public.productionorder (
    id integer NOT NULL,
    productid integer NOT NULL,
    ordernumber character varying(255) NOT NULL,
    batchnumber character varying(255) NOT NULL,
    location character varying(255),
    profcenter character varying(255),
    createddate timestamp without time zone NOT NULL,
    createdby character varying(255) NOT NULL,
    updateddate timestamp without time zone,
    updatedby character varying(255),
    orderdate timestamp without time zone NOT NULL
);
 #   DROP TABLE public.productionorder;
       public         heap    postgres    false            �            1259    75481    productionorder_id_seq    SEQUENCE     �   CREATE SEQUENCE public.productionorder_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.productionorder_id_seq;
       public          postgres    false    214                       0    0    productionorder_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.productionorder_id_seq OWNED BY public.productionorder.id;
          public          postgres    false    213            �            1259    75448    productionordersn    TABLE     �   CREATE TABLE public.productionordersn (
    id integer NOT NULL,
    headerid integer,
    serialnumber character varying NOT NULL
);
 %   DROP TABLE public.productionordersn;
       public         heap    postgres    false            �            1259    75447    productionordersn_id_seq    SEQUENCE     �   CREATE SEQUENCE public.productionordersn_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.productionordersn_id_seq;
       public          postgres    false    212                       0    0    productionordersn_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.productionordersn_id_seq OWNED BY public.productionordersn.id;
          public          postgres    false    211            f           2604    67243    msuser userid    DEFAULT     n   ALTER TABLE ONLY public.msuser ALTER COLUMN userid SET DEFAULT nextval('public.msuser_userid_seq'::regclass);
 <   ALTER TABLE public.msuser ALTER COLUMN userid DROP DEFAULT;
       public          postgres    false    209    210    210            h           2604    75485    productionorder id    DEFAULT     x   ALTER TABLE ONLY public.productionorder ALTER COLUMN id SET DEFAULT nextval('public.productionorder_id_seq'::regclass);
 A   ALTER TABLE public.productionorder ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    214    213    214            g           2604    75451    productionordersn id    DEFAULT     |   ALTER TABLE ONLY public.productionordersn ALTER COLUMN id SET DEFAULT nextval('public.productionordersn_id_seq'::regclass);
 C   ALTER TABLE public.productionordersn ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    212    211    212            �          0    67240    msuser 
   TABLE DATA           x   COPY public.msuser (userid, username, password, last_login, createddate, createdby, updateddate, updatedby) FROM stdin;
    public          postgres    false    210   �       �          0    75482    productionorder 
   TABLE DATA           �   COPY public.productionorder (id, productid, ordernumber, batchnumber, location, profcenter, createddate, createdby, updateddate, updatedby, orderdate) FROM stdin;
    public          postgres    false    214   J       �          0    75448    productionordersn 
   TABLE DATA           G   COPY public.productionordersn (id, headerid, serialnumber) FROM stdin;
    public          postgres    false    212   �       	           0    0    msuser_userid_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.msuser_userid_seq', 2, true);
          public          postgres    false    209            
           0    0    productionorder_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.productionorder_id_seq', 4, true);
          public          postgres    false    213                       0    0    productionordersn_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.productionordersn_id_seq', 865, true);
          public          postgres    false    211            j           2606    67247    msuser msuser_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.msuser
    ADD CONSTRAINT msuser_pkey PRIMARY KEY (userid);
 <   ALTER TABLE ONLY public.msuser DROP CONSTRAINT msuser_pkey;
       public            postgres    false    210            n           2606    75489 $   productionorder productionorder_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.productionorder
    ADD CONSTRAINT productionorder_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.productionorder DROP CONSTRAINT productionorder_pkey;
       public            postgres    false    214            l           2606    75455 (   productionordersn productionordersn_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.productionordersn
    ADD CONSTRAINT productionordersn_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.productionordersn DROP CONSTRAINT productionordersn_pkey;
       public            postgres    false    212            �   �   x�mͻ�0@�}
V��)�l@c"A�@�"W�<�:�8��|E��R"	�D�T��'�����G�/{9�iq%m!ȡ�M����d��Y��]�BmL�CC�~���Pߦ�/c�!��jêNo2����L��6/�S_�U��yݤ�����[���~�P�� ��;x      �   �   x����
1�s��@%3I�no����a��;�
+� �@oB �J�ր\o�����5�����wjW
d9��:�NG�&��D����"�l�[��Or9�F�����G���nf3]5�6s�w/zi?��}J�H 7i      �   !  x�M�1�0@��>L�4���\"M�r�Un�/ؐ�j���b@�������c�?{|�?�sc̾�^ğߟo���x�����9�����s�+^�C��~_����z�}���|��jd9՛5ؔo�K������)����|)��W�|%߽��o�+��e�|_�w���J�����J�����Z�����Z����|-_�k�_��Z�����-_����-_����-�·�[��|ߖo���-|[���ȷ���#��w�[��|��ȗ��|��ȗ��|��ȗ��/��h��i�r����-_Z���|�|�h�
ߐ���
ߐ���
ߐ���ߐ���ߐ���ߔ��M�ߔ��M�ߔo��m|S��oʷ�M�6�)���m|!���m|!���|!���|!���|!����;��|ߒ��[�|z?����X�W�ʻP< �ۃ{����y<�P8�W���ψ��\��LZzW+-������JK�v��w��һ_e�]���nXYzW�,�;V��d��=�Ͽ�:|�     