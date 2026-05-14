# 04 — AI Models

## NeuroGift Intelligence Classification Model

### Overview
نموذج تصنيف ذكاء بشري مبني على بيانات EEG (تخطيط الدماغ الكهربائي).
يحدد نوع ذكاء المستخدم من 5 أنواع بناءً على إشارات الموجات الدماغية.

---

## Model Details

| Property | Value |
|---|---|
| **Algorithm** | Random Forest Classifier |
| **Library** | scikit-learn |
| **File** | NeuroGift_Final_Model.pkl |
| **Serialization** | joblib |
| **Training Accuracy** | 99.99% |
| **Weighted F1-Score** | 1.00 |

---

## Intelligence Classes (5 Types)

| Class | Arabic | Description |
|---|---|---|
| Visual | بصري-مكاني | يتعلم بالمخططات والصور والرسوم |
| Linguistic | لغوي | يتعلم بالقراءة والكتابة والاستماع |
| Logical | منطقي-رياضي | يتعلم بالأنماط والتحليل والمنطق |
| Musical | موسيقي | يتعلم بالإيقاع والتكرار الصوتي |
| Kinesthetic | حركي | يتعلم بالتجربة العملية |

---

## Dataset

| File | Samples |
|---|---|
| Musical_Processed.csv | 2,797,458 |
| Linguistic_Processed.csv | 4,500 |
| Visual_Processed.csv | 1,000 |
| Kinesthetic_Processed.csv | 373 |
| Logical_Processed.csv | 186 |
| **Total** | **2,803,517** |

---

## Model Architecture

Random Forest Classifier
- n_estimators = 100
- class_weight = balanced
- random_state = 42
- Train/Test Split: 80% / 20%

---

## Performance

| Intelligence | Precision | Recall | F1 | Support |
|---|---|---|---|---|
| Kinesthetic | 1.00 | 1.00 | 1.00 | 75 |
| Linguistic | 1.00 | 1.00 | 1.00 | 898 |
| Logical | 1.00 | 1.00 | 1.00 | 28 |
| Musical | 1.00 | 1.00 | 1.00 | 559,508 |
| Visual | 1.00 | 0.99 | 1.00 | 195 |
| **Weighted Avg** | **1.00** | **1.00** | **1.00** | **560,704** |

**Overall Accuracy: 99.99%**

---

## Training Notebook

Google Colab: Netro_model.ipynb

Pipeline:
1. ربط Google Drive
2. تجميع بيانات الـ 5 classes من Processed_Data
3. تقسيم البيانات 80/20
4. تدريب Random Forest مع class_weight=balanced
5. تقييم الأداء وحفظ النموذج بـ joblib

---

## Known Limitations

- Class Imbalance: Musical (2.7M) >> Kinesthetic (373) — تم معالجتها بـ class_weight=balanced
- Kinesthetic Data: 373 عينة فقط — يحتاج مزيد من البيانات
- Model files stored on Google Drive due to size
