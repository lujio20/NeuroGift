# 04 — AI Models

NeuroGift is powered by two AI layers working together to deliver a fully personalized learning experience.

---

## Model 1 — EEG Intelligence Classifier (Custom Trained)

### Overview
A Random Forest classifier trained on real EEG (Electroencephalography) brainwave data.
It automatically identifies a user's dominant intelligence type based on their neural activity patterns during a short cognitive assessment — no questionnaires, no guessing.

---

### Model Details

| Property | Value |
|---|---|
| **Algorithm** | Random Forest Classifier |
| **Library** | scikit-learn |
| **Model File** | `NeuroGift_Final_Model.pkl` |
| **Serialization** | joblib |
| **Test Accuracy** | ~99.79% |
| **CV Score** | 99.79% ± 0.14% (5-fold Stratified Cross-Validation) |
| **Overfitting** | None detected — gap < 0.3% between Test and CV |

---

### Intelligence Classes (5 Types)

| Class | Arabic | How They Learn Best |
|---|---|---|
| Visual-Spatial | بصري-مكاني | Diagrams, maps, charts, infographics, videos |
| Linguistic | لغوي | Reading, writing, lectures, discussions |
| Logical-Mathematical | منطقي-رياضي | Patterns, logic, problem-solving, code |
| Musical | موسيقي | Rhythm, sound, audio repetition, mnemonics |
| Kinesthetic | حركي | Hands-on practice, projects, labs, movement |

---

### Dataset

#### Raw Data Sources

| Folder | Format | Description |
|---|---|---|
| `Raw_Data_EDF/` | `.edf` | Raw EEG signals — European Data Format |
| `Raw_Data_MAT/` | `.mat` | Same data in MATLAB format |
| `Raw_Data_Music/` | `.edf` | EEG signals captured during music listening |

#### Processed Data (used for training)

| File | Raw Samples | After Balancing |
|---|---|---|
| Musical_Processed.csv | 2,797,458 | 5,000 |
| Linguistic_Processed.csv | 4,500 | 4,500 |
| Visual_Processed.csv | 1,000 | 1,000 |
| Kinesthetic_Processed.csv | 373 | 373 |
| Logical_Processed.csv | 186 | 186 |
| **Total** | **2,803,517** | **~11,059** |

> Class imbalance was handled via undersampling — Musical class reduced from 2.7M to 5,000 to prevent the model from being biased toward it.

#### EEG Features (Frequency Bands)

| Band | Frequency | Neural State |
|---|---|---|
| Alpha | 8–13 Hz | Relaxation, attention |
| Beta | 13–30 Hz | Active thinking, focus |
| Theta | 4–8 Hz | Memory, creativity |
| Gamma | 30+ Hz | High-level cognition |

---

### Model Architecture

```python
RandomForestClassifier(
    n_estimators      = 200,     # number of trees
    max_depth         = 20,      # prevents overfitting
    min_samples_split = 10,      # minimum samples to split a node
    min_samples_leaf  = 5,       # minimum samples in a leaf
    class_weight      = 'balanced',  # handles remaining class imbalance
    random_state      = 42,
    n_jobs            = -1       # use all CPU cores
)
```

Train / Test Split: **80% training — 20% testing** (stratified by class)

---

### Validation Results

| Metric | Value | Interpretation |
|---|---|---|
| Test Accuracy | ~99.79% | Performance on unseen test data |
| CV Score (5-fold) | 99.79% ± 0.14% | Consistent across all folds |
| Overfitting gap | < 0.3% | Model generalizes — not memorizing |

#### Classification Report (per class)

| Intelligence | Precision | Recall | F1-Score |
|---|---|---|---|
| Kinesthetic | 1.00 | 1.00 | 1.00 |
| Linguistic | 1.00 | 1.00 | 1.00 |
| Logical | 1.00 | 1.00 | 1.00 |
| Musical | 1.00 | 1.00 | 1.00 |
| Visual | 1.00 | 0.99 | 1.00 |
| **Weighted Avg** | **1.00** | **1.00** | **1.00** |

---

### Training Notebook

Google Colab: [model v.02.ipynb](https://colab.research.google.com/drive/1mPMGkGqiAFUF4VzHrG-p9Yxj8TKIp2xh)

#### Pipeline

```
1. Mount Google Drive
2. Load 5 EEG CSV files (Processed_Data/)
3. Balance classes — undersample Musical to 5,000
4. Shuffle dataset (random_state=42)
5. Train/Test split — 80/20 stratified
6. Train Random Forest (200 trees)
7. Evaluate — accuracy + classification report
8. Cross-Validation — 5-fold Stratified CV
9. Save model — joblib → NeuroGift_Final_Model.pkl
```

#### Usage

```python
import joblib
import pandas as pd

# Load model
model = joblib.load('NeuroGift_Final_Model.pkl')

# Predict
# sample: DataFrame with same EEG feature columns as training data
prediction  = model.predict(sample)[0]
confidence  = round(max(model.predict_proba(sample)[0]) * 100, 2)

print(f"Intelligence Type: {prediction}")
print(f"Confidence: {confidence}%")
```

---

## Model 2 — Content Transformation Engine

### Overview
When a user's intelligence type is identified, some courses on the platform will not match their learning style. Instead of removing those courses, Model 2 transforms them into a format that works for the user.

### Transformation Outputs

| Format | Description |
|---|---|
| **Concept Map** | Key ideas and their relationships visualized |
| **Keywords** | Core terms extracted from the course |
| **Visual Outputs** | Diagrams, mindmaps, flowcharts, cheat sheets |
| **Flashcards** | Q&A pairs for quick review and retention |

### Current Status
The transformation engine is implemented as a rule-based demo in the current prototype (`full-courses.html`).

> **Planned:** Integration with GPT / Gemini API for dynamic, AI-generated content transformation based on actual course material.

---

## Content Personalization Algorithm

### Overview
After the EEG classifier identifies the user's intelligence type, this algorithm scores every course in the feed and labels it as either **Best For You** or **Needs Transform**.

> **Status: Designed & Documented — Not yet integrated into the web prototype.**
> See full details: [Content_Personalization_Algorithm.md](Content_Personalization_Algorithm.md)

### How It Works

```
Intelligence Type (from Model 1)
        ↓
Map to Learning Style Profile
  Visual    → [diagrams, video, infographic, design]
  Linguistic → [reading, writing, lecture, text]
  Logical   → [programming, math, logic, analysis]
  Musical   → [audio, rhythm, sound, podcast]
  Kinesthetic → [hands-on, project, practice, lab]
        ↓
Score each course (tag overlap / profile size)
        ↓
Label:
  score ≥ 0.3 → Best For You ✅
  score < 0.3 → Needs Transform 🔄
        ↓
Return sorted feed (highest score first)
```

---

## Files in This Folder

```
04_AI_Models/
├── README.md                              ← this file
├── Content_Personalization_Algorithm.md  ← full algorithm design + code
├── NeuroGift_Final_Model.pkl              ← trained model (stored on Google Drive)
└── Confusion_Matrix.png                   ← visual evaluation results (Google Drive)
```

> Model files are stored on Google Drive due to size constraints.
> Google Drive folder: [NeuroGift_Project](https://drive.google.com/drive/folders/18fQuadp2ptAm0cxqCKjPIp9OD3qzoLDO)
