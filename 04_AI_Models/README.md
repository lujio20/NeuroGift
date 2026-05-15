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

# Content Personalization Algorithm

> **Status: Designed & Documented — Not yet integrated into the web prototype.**
> The algorithm is ready for implementation. Integration with the live platform is a planned next step.

---

## Overview

After the EEG classifier identifies the user's intelligence type, this algorithm scores and ranks educational content by compatibility with the user's learning profile.

```
EEG Classifier Output
        ↓
Intelligence Type (e.g. Visual-Spatial)
        ↓
Content Personalization Algorithm
        ↓
Ranked Feed:
  → Best For You   (match score ≥ 0.3)
  → Needs Transform (match score < 0.3)
```

---

## Intelligence → Learning Style Mapping

Each intelligence type maps to a set of content keywords that reflect how that type of learner absorbs information best.

```python
INTELLIGENCE_PROFILES = {
    'Visual':      ['visual', 'diagram', 'design', 'video', 'infographic', 'chart'],
    'Linguistic':  ['reading', 'writing', 'language', 'lecture', 'text', 'article'],
    'Logical':     ['math', 'programming', 'logic', 'problem', 'analysis', 'code'],
    'Musical':     ['audio', 'rhythm', 'sound', 'music', 'podcast', 'pattern'],
    'Kinesthetic': ['hands-on', 'practice', 'build', 'project', 'lab', 'exercise']
}
```

---

## Course Schema

Every course in the system carries a set of tags that describe its content format and delivery style.

```python
COURSES = [
    {
        'title':    'UX Design Professional Certificate',
        'platform': 'Coursera',
        'tags':     ['visual', 'design', 'diagram'],
        'url':      'https://coursera.org/...'
    },
    {
        'title':    'Python Full Course for Beginners',
        'platform': 'YouTube',
        'tags':     ['programming', 'code', 'logic'],
        'url':      'https://youtube.com/...'
    },
    {
        'title':    'Arabic NLP Fundamentals',
        'platform': 'Satr',
        'tags':     ['text', 'language', 'writing'],
        'url':      'https://satr.codes/...'
    }
]
```

---

## Scoring Function

```python
def score_course(course: dict, intelligence_type: str) -> float:
    """
    Returns a compatibility score between 0.0 and 1.0.
    Score = (matching tags) / (total profile tags)
    """
    profile = INTELLIGENCE_PROFILES.get(intelligence_type, [])
    if not profile:
        return 0.0
    matches = len(set(course['tags']) & set(profile))
    return round(matches / len(profile), 2)


def get_personalized_feed(intelligence_type: str) -> list:
    """
    Returns all courses sorted by compatibility score (descending).
    Each course is labeled 'Best For You' or 'Needs Transform'.
    """
    results = []
    for course in COURSES:
        score = score_course(course, intelligence_type)
        results.append({
            **course,
            'score': score,
            'label': 'Best For You' if score >= 0.3 else 'Needs Transform'
        })
    return sorted(results, key=lambda x: x['score'], reverse=True)
```

---

## Example Output

For a **Visual-Spatial** user:

```
Title                              Platform   Score   Label
─────────────────────────────────────────────────────────────
UX Design Professional Certificate Coursera   0.50    Best For You
Python Full Course for Beginners   YouTube    0.17    Needs Transform
Arabic NLP Fundamentals            Satr       0.00    Needs Transform
```

---

## Scalability

The algorithm is designed to be source-agnostic.
Any content source can feed into the same scoring logic:

```
YouTube API   ─┐
Coursera API  ─┼──► tag extraction ──► score_course() ──► ranked feed
Satr API      ─┘
Scraped data  ─┘
```

Only the tags need to be extracted or assigned — the core algorithm remains unchanged.

---

## Planned Integration

| Step | Description | Status |
|---|---|---|
| 1 | Algorithm design & documentation | ✅ Done |
| 2 | Add tags to existing hardcoded courses | ⏳ Pending |
| 3 | Replace static course labels in courses.html | ⏳ Pending |
| 4 | Connect to EEG classifier output | ⏳ Pending |
| 5 | YouTube / Coursera API integration | 🔮 Future |
| 6 | GPT/Gemini for dynamic tag extraction | 🔮 Future |

